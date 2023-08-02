<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <div class="row">
        <div class="table-responsive">  
          <table class="table table-hover" id="table1" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th width="5%" class="text-center">S.N</th>
                <th width="10%">Payment Date</th>
                <th width="10%" class="text-right">Amount</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $counter=0;
              $payment_total=0;
              if (!empty($payment_list)) { 
                foreach ($payment_list as $row):
                  $payment_total+=$row->amount;
                ?>
                <tr>
                  <td class="text-center"><?php echo ++$counter;?></td>
                  <td><?php echo $row->payment_date;?></td>
                  <td class="text-right"><?php echo $row->amount;?></td>
                  <td></td>
                </tr>
                <?php
                endforeach;
              }
              ?>
                <tr>
                  <td class="text-center"></td>
                  <th class="text-right">Total : </th>
                  <th class="text-right"><?php echo $payment_total;?></th>
                  <td></td>
                </tr>
              </tbody>
          </table>
        </div><!-- table-responsive -->
      </div><!-- col-md-6 -->
    </div>
  </div>
  <!-- /.box -->
  </section>