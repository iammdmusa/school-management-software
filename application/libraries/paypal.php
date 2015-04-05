<?php
/*********************************************************

* DO NOT REMOVE *

Project: PHP PayPal Class 1.0
Url: http://phpweby.com
Copyright: (C) 2009 Blagoj Janevski - bl@blagoj.com
Project Manager: Blagoj Janevski

For help, comments, feedback, discussion ... please join our
Webmaster forums - http://forums.phpweby.com

License------------------------------------------------:
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
End License----------------------------------------------

*********************************************************/

class paypal
{
	var $logfile='ipnlog.txt';
	var $form=array();
	var $log=0;
    //var $form_action='https://www.paypal.com/cgi-bin/webscr';
	var $form_action='https://www.sandbox.paypal.com/cgi-bin/webscr';
	var $paypalurl='www.paypal.com';
	var $type='payment';
	var $posted_data=array();
	var $action='';
	var $error='';
	var $ipn='';
	var $price=0;
	var $payment_success=0;
	var $ignore_type=array();


	function paypal($price_item=0)
	{
		$this->price=$price_item;
	}

	function validate_ipn()
	{
		if(!empty($_POST))
		{
			$postvars='';
			$this->price=0;

			foreach($_POST as $key=>$value)
			{
				$postvars.=$key. '=' . urlencode($value) . '&';
				$this->posted_data[$key]=$value;
			}

			$postvars.="cmd=_notify-validate";

			$errstr=$errno='';
			$fp= @ fsockopen($this->paypalurl,80,$errno,$errstr,30);

			if(!$fp)
			{
				$this->error="fsockopen error no. $errno: $errstr";
				return 0;
			}

			@ fputs($fp, "POST /cgi-bin/webscr HTTP/1.1\r\n");
			@ fputs($fp, "Host: ".$this->paypalurl."\r\n");
			@ fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
			@ fputs($fp, "Content-length: ".strlen($postvars)."\r\n");
			@ fputs($fp, "Connection: close\r\n\r\n");
			@ fputs($fp, $postvars . "\r\n\r\n");

			$str='';

			while(!feof($fp))
			$str.=@ fgets($fp,1024);

			@ fclose($fp);

			if(preg_match('/VERIFIED/i',$str))
			{
				if($this->log)
				$this->log_results(1);
					
				if(preg_match('/subscr/',$this->posted_data['txn_type']))
				{
					$this->type='subscription';

					if(in_array($this->posted_data['txn_type'],$this->ignore_type))
					return 0;
					
					if($this->posted_data['txn_type']=='subscr_payment')
					{
						if($this->posted_data['payment_status']=='Completed')
						{
							$this->price=$this->posted_data['mc_amount3'];
							$this->payment_success=1;
						}
					}

				}
				else
				{
					if($this->posted_data['payment_status']=='Completed')
					{
						$this->type='payment';
						$this->price=$this->posted_data['mc_gross'];
						$this->payment_success=1;
					}
				}

				return 1;
			}
			else
			{
				if($this->log)
				$this->log_results(0);

				$this->error='IPN verification failed.';
				return 0;
			}
		}
		else
		return 0;
	}

	function add($name,$value)
	{
		$this->form[$name]=$value;
	}

	function remove($name)
	{
		unset($this->form[$name]);
	}

	function enable_recurring()
	{
		$this->type='subscription';
		$this->add('src','1');
		$this->add('sra','1');
		$this->add('cmd','_xclick-subscriptions');
		$this->remove('amount');
		$this->add('no_note',1);
		$this->add('no_shipping',1);
		$this->add('currency_code','USD');
		$this->add('a3',$this->price);
		$this->add('notify_url',$this->ipn);

	}

	function recurring_year($num)
	{
		$this->enable_recurring();
		$this->add('t3','Y');
		$this->add('p3',$num);
	}

	function recurring_month($num)
	{
		$this->enable_recurring();
		$this->add('t3','M');
		$this->add('p3',$num);
	}

	function recurring_day($num)
	{
		$this->enable_recurring();
		$this->add('t3','D');
		$this->add('p3',$num);
	}


	function enable_payment()
	{
		$this->type='payment';
		$this->remove('t3');
		$this->remove('p3');
		$this->remove('a3');
		$this->remove('src');
		$this->remove('sra');
		$this->add('amount',$this->price);
		$this->add('cmd','_xclick');
		$this->add('no_note',1);
		$this->add('no_shipping',1);
		$this->add('currency_code','USD');
		$this->add('notify_url',$this->ipn);
	}
	function output_form()
	{

		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
		. '<html xmlns="http://www.w3.org/1999/xhtml"><head><title>Redirecting to PayPal...</title></head>'
		.'<body onload="document.f.submit();"><h3>Redirecting to PayPal...</h3>'
		. '<form name="f" action="'.$this->form_action.'" method="post">';

		foreach($this->form as $k=>$v)
		{
			echo '<input type="hidden" name="' . $k . '" value="' . $v . '" />';
		}

		echo '<input type="submit" value="Click here if you are not redirected within 10 seconds" /></form></body></html>';


	}

	function reset_form()
	{
		$this->form=array();
	}

	function log_results($var)
	{
		$fp=@ fopen($this->logfile,'a');
		$data=date('m/d/Y g:i A');
		if($var==1)
		{
			$str="\nIPN PAYPAL TRANSACTION ID: " . $this->posted_data['txn_id'] ."\n";
			$str.="SUCCESS\n";
			$str.="DATE: ". $data . "\n";
			$str.="PAYER EMAIL: " . $this->posted_data['payer_email']. "\n";
			$str.="NAME: " . $this->posted_data['last_name']." ".$this->posted_data['first_name']. "\n";
			$str.="LINK ID: ". $this->posted_data['item_number']. "\n";
			$str.="QUANTITY: ". $this->posted_data['quantity']. "\n";
			$str.="TOTAL: "   . $this->posted_data['mc_gross']. "\n\n\n";
		}
		else
		{
			$str="\nIPN PAYPAL TRANSACTION ID:\n";
			$str.="INVALID\n";
			$str.="REMOTE IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
			$str.="ERROR: ". $this->posted_data['error'] . "\n";
			$str.="DATE: ". $data . "\n";
			$str.="PAYER EMAIL: " . $this->posted_data['payer_email']. "\n";
			$str.="NAME: " . $this->posted_data['last_name']." ".$this->posted_data['first_name']. "\n";
			$str.="LINK ID: ". $this->posted_data['item_number']. "\n";
			$str.="QUANTITY: ". $this->posted_data['quantity']. "\n";
			$str.="TOTAL: "   . $this->posted_data['mc_gross']. "\n\n\n";
		}
		if($fp)
		@ fputs($fp,$str);

		@ fclose($fp);
	}

	function headers_nocache()
	{
		header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: pre-check=0, post-check=0, max-age=0');
		header('Pragma: no-cache');
	}


}
