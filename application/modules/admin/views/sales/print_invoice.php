<div id="printarea">
  <table  width="270px" style="font-size:12px; line-height:14px;">
    <tr>
      <td colspan="4" align="center"><table  width="100%" style="font-size:14px;">
          <tr style="line-height:18px;">
            <td style="font-size:18px; font-weight:bold;" colspan="2" align="center"><?php if($sales->seller==0) echo 'City Store Nepal'; else echo $this->general_model->getValue('business_name','tbl_seller','id="'.$sales->seller.'"');?></td>
          </tr>
          <tr>
            <td colspan="2" align="center" style="padding:10px 0 15px 0; font-size:16px;">ORDER CONFIRMATION</td>
          </tr>
          <tr style="line-height:16px;">
            <td><strong>ESTIMATE No. : </strong><?php echo 10000+$sales->id;?></td>
            <td align="right"><strong>DATE : </strong><?php echo date("d-m-Y");?></td>
          </tr>
          <tr style="line-height:16px;">
            <td colspan="2" style="width:100px;"><strong>Name : </strong><?php  echo ucfirst($customer->full_name);?></td>
          </tr>
          <tr style="line-height:16px;">
            <td colspan="2" valign="top"><strong>Address : </strong><?php if(!empty($customer->full_address)) echo $customer->full_address; ?></td>
          </tr>
          <tr style="line-height:16px;">
            <td colspan="2" style="padding-bottom:15px;"><strong>Contact No. : </strong><?php if(!empty($customer->contact_number)) echo $customer->contact_number; ?></td>
          </tr>
          <?php if(!empty($sales->customer_remarks)){?>
          <tr>
            <td colspan="2" style="padding-bottom:15px;"><strong>Remarks : </strong><?php echo $sales->customer_remarks; ?></td>
          </tr>
          <?php } ?>
        </table></td>
    </tr>
    <tr>
      <td width="35" align="center" style="border-bottom:1pt solid black; font-weight:bold; font-size:13px;margin-bottom:3px;"><strong>Qty</strong></td>
      <td style="border-bottom:1pt solid black; font-weight:bold; font-size:13px;"><strong>Particulars</strong></td>
      <td style="border-bottom:1pt solid black; font-weight:bold; font-size:13px;" align="right" ><strong>Rate</strong></td>
      <td style="border-bottom:1pt solid black; font-weight:bold; font-size:13px;" align="right" ><strong>Amount</strong></td>
    </tr>
    <?php
    $discount=$sales->discount_amount;
    $delivery_charge = $sales->delivery_charge_paid_by_client;
    $count=1;
    $total_amount = 0;
    $net_amount = 0;

	  foreach($sales_items as $item)
    {
      $total_amount+=$item->total_amount;
    ?>
    <tr>
      <td valign="top" style="font-size:12px;" align="center"><?php echo $item->quantity;?></td>
      <td valign="top" style="font-size:12px; padding-right:5px;"><?php echo $this->general_model->getValue('name','tbl_product','id="'.$item->product_id.'"'); ?><br>
        Color : <?php echo $this->general_model->getValue('attribute_value','tbl_attribute_values','id="'.$item->color_id.'"'); ?><br>
        Size : <?php echo $this->general_model->getValue('attribute_value','tbl_attribute_values','id="'.$item->size_id.'"'); ?></td>
      <td valign="top" style="font-size:12px;" align="right"><?php echo $item->rate;?></td>
      <td valign="top" style="font-size:12px;" align="right"><?php echo $item->total_amount;?></td>
    </tr>
    <tr>
      <td colspan="4"><hr style="border-top: 1px dashed;"/></td>
    </tr>
    <?php
    }
    $net_amount = $total_amount-$discount;
    $net_amount = $net_amount+$delivery_charge;
    ?>
    <tr>
      <td valign="top" colspan="3" align="right" style="border-top:1pt solid black; font-size:13px;"><strong>Total amount : </strong></td>
      <td valign="top" align="right" style="border-top:1pt solid black; font-size:13px;"><strong>
        <?php if(isset($total_amount)) echo round($total_amount,2);?>
        </strong></td>
    </tr>
    <?php if($discount>0){?>
    <tr>
      <td valign="top" colspan="3"  align="right" style="font-size:13px;"><strong>Discount : </strong></td>
      <td valign="top" align="right" style="font-size:13px;"><strong>-
        <?php if(isset($discount)) echo round($discount,2);?>
        </strong></td>
    </tr>
    <?php } if($delivery_charge>0){?>
    <tr>
      <td valign="top" colspan="3"  align="right" style="font-size:13px;"><strong>Delivery Charge : </strong></td>
      <td valign="top" align="right" style="font-size:13px;"><strong>+<?php if(isset($delivery_charge)) echo round($delivery_charge,2); else echo round($rasSales['delivery_charge'],2);?></strong></td>
    </tr>
    <?php } if($delivery_charge>0 || $discount>0){ ?>
    <tr>
      <td valign="top" colspan="3" align="right" style="border-top:2pt solid black; font-size:13px;"><strong>Net Amount : </strong></td>
      <td valign="top" align="right" style="border-top:2pt solid black; font-size:13px;"><strong>
        <?php if(isset($net_amount)) echo round($net_amount,2);?>
        </strong></td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="4" style="padding-top:5px; padding-bottom:3px; font-size:13px;"><strong>In Words:
        <?php if(isset($net_amount)) echo convert_number($net_amount); ?>
        &nbsp;Rupees Only</strong></td>
    </tr>
    <tr>
      <td valign="top" colspan="4" style="border-top:1pt solid black; padding-top:3px;"><strong>Note : </strong><br>
        <ul style="padding-left: 13px;">
          <li>Clothings once sold can be taken back or exchanged based on our return policy. <!-- Please check our website for more details. --></li>
          <li>This is just a computer generated estimate.</li>
        </ul></td>
    </tr>
    <tr>
      <td valign="bottom" colspan="4" style="padding-top:40px; text-align:right;">Signature</td>
    </tr>
  </table>
</div>
<table width="100%" class="FormTbl">
  <tr>
    <td><input type="button" name="btnprint" id="btnprint" value="Print" class="btn btn-sm btn-success" onclick="printDiv('printarea')">
  </tr>
</table>
<script type="text/javascript">
function printDiv(divName) {
  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;
  document.body.innerHTML = printContents;
  window.print();
  window.location = "<?php echo base_url() . 'admin/sales/details/' . $sales->id;?>";
  document.body.innerHTML = originalContents;
}
</script>
<?php
function convert_number($number)
{
	if (($number < 0) || ($number > 999999999))
	{
		throw new Exception("Number is out of range");
	}

	$Gn = floor($number / 100000);  /* Millions (giga) */
	$number -= $Gn * 100000;
	$kn = floor($number / 1000);     /* Thousands (kilo) */
	$number -= $kn * 1000;
	$Hn = floor($number / 100);      /* Hundreds (hecto) */
	$number -= $Hn * 100;
	$Dn = floor($number / 10);       /* Tens (deca) */
	$n = $number % 10;               /* Ones */

	$res = "";
	if ($Gn)
	{
		$res .= convert_number($Gn) . " Lacs";
	}

	if ($kn)
	{
		$res .= (empty($res) ? "" : " ") .
		convert_number($kn) . " Thousand";
	}
	
	if ($Hn)
	{
		$res .= (empty($res) ? "" : " ") .
		convert_number($Hn) . " Hundred";
	}

	$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
	$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
	if ($Dn || $n)
	{
		if (!empty($res))
		{
			$res .= " and ";
		}
		if ($Dn < 2)
		{
			$res .= $ones[$Dn * 10 + $n];
		}
		else
		{
		$res .= $tens[$Dn];
			if ($n)
			{
				$res .= "-" . $ones[$n];
			}
		}
	}

	if (empty($res))
	{
		$res = "zero";
	}
	return $res;
}
?>