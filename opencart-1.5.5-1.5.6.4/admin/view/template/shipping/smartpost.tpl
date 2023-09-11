<?php echo $header ?>
<div id="content">
  <div class="breadcrumb">
        <?php foreach( $breadcrumbs as $breadcrumb ){?>
        <a href="<?php echo $breadcrumb['href'] ?>"><?php echo $breadcrumb['text'] ?></a>
        <?php } ?>
  </div>

    
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>

      <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title ?></h1>

<div class="box">
    <div class="heading">
      <div class="buttons">
        <a onclick="$('#form-shipping').submit();" class="button"><?php echo $button_save; ?></a>
        <a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a>
      </div>
    </div>


   <div class="content">
        
            <div id="tabs" class="htabs">
              <a href="#tab-general"><?php echo $tab_general ?></a>
              <a href="#tab-hinnasto"><?php echo $tab_hinnasto ?></a>
            </div>


    <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="form-shipping" class="form-horizontal">

    <div id="tab-general">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status ?></label>
            <div class="col-sm-10">
              <select name="smartpost_status" id="input-status" class="form-control">
                <?php if ( $smartpost_status ){?>
                <option value="1" selected="selected"><?php echo $text_enabled ?></option>
                <option value="0"><?php echo $text_disabled ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-tax-class"><?php echo $entry_tax_class ?></label>
            <div class="col-sm-10">
              <select name="smartpost_tax_class_id" id="input-tax-class" class="form-control">
                <option value="0"><?php echo $text_none ?></option>
                <?php foreach( $tax_classes as $tax_class ){?>
                <?php if ( $tax_class['tax_class_id'] == $smartpost_tax_class_id ){?>
                <option value="<?php echo $tax_class['tax_class_id'] ?>" selected="selected"><?php echo $tax_class['title'] ?></option>
                <?php } else { ?>
                <option value="<?php echo $tax_class['tax_class_id'] ?>"><?php echo $tax_class['title'] ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-weight-class"><?php echo $entry_weight_class ?></label>
            <div class="col-sm-10">
              <select name="smartpost_weight_class_id" id="input-weight-class" class="form-control">
                <option value="0"><?php echo $text_none ?></option>
                <?php foreach( $weight_classes as $weight_class ){?>
                <?php if ( $weight_class['weight_class_id'] == $smartpost_weight_class_id ){?>
                <option value="<?php echo $weight_class['weight_class_id'] ?>" selected="selected"><?php echo $weight_class['title'] ?></option>
                <?php } else { ?>
                <option value="<?php echo $weight_class['weight_class_id'] ?>"><?php echo $weight_class['title'] ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-weight-class"><?php echo $entry_length_class ?></label>
            <div class="col-sm-10">
              <select name="smartpost_length_class_id" id="input-weight-class" class="form-control">
                <option value="0"><?php echo $text_none ?></option>
                <?php foreach( $length_classes as $length_class ){?>
                <?php if ( $length_class['length_class_id'] == $smartpost_length_class_id ){?>
                <option value="<?php echo $length_class['length_class_id'] ?>" selected="selected"><?php echo $length_class['title'] ?></option>
                <?php } else { ?>
                <option value="<?php echo $length_class['length_class_id'] ?>"><?php echo $length_class['title'] ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone ?></label>
            <div class="col-sm-10">
              <select name="smartpost_geo_zone_id" id="input-geo-zone" class="form-control">
                <option value="0"><?php echo $text_all_zones ?></option>
                <?php foreach( $geo_zones as $geo_zone ){?>
                <?php if ( $geo_zone['geo_zone_id'] == $smartpost_geo_zone_id ){?>
                <option value="<?php echo $geo_zone['geo_zone_id'] ?>" selected="selected"><?php echo $geo_zone['name'] ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id'] ?>"><?php echo $geo_zone['name'] ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-free-cargo"><?php echo $entry_free_cargo ?></label>
            <div class="col-sm-10">
              <select name="smartpost_free_cargo" id="input-free-cargo" class="form-control">
                <?php if ( $smartpost_free_cargo ){?>
                <option value="1" selected="selected"><?php echo $text_enabled ?></option>
                <option value="0"><?php echo $text_disabled ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-discount-cargo"><?php echo $entry_discount_cargo ?></label>
            <div class="col-sm-10">
              <select name="smartpost_discount_cargo" id="input-discount-cargo" class="form-control">
                <?php if ( $smartpost_discount_cargo ){?>
                <option value="1" selected="selected"><?php echo $text_enabled ?></option>
                <option value="0"><?php echo $text_disabled ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-cargo-sum"><?php echo $entry_cargo_sum ?></label>
            <div class="col-sm-10">
              <input type="text" name="smartpost_cargo_sum" value="<?php echo $smartpost_cargo_sum ?>" placeholder="<?php echo $entry_cargo_sum ?>" id="input-cargo-sum" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-discount-cargo-percent"><?php echo $entry_discount_cargo_percent ?></label>
            <div class="col-sm-10">
              <input type="text" name="smartpost_discount_cargo_percent" value="<?php echo $smartpost_discount_cargo_percent ?>" placeholder="<?php echo $entry_discount_cargo_percent ?>" id="input-discount-cargo-percent" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-top"><?php echo $entry_top ?></label>
            <div class="col-sm-10">
              <input type="text" name="smartpost_top" value="<?php echo $smartpost_top ?>" placeholder="<?php echo $entry_top ?>" id="input-top" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order ?></label>
            <div class="col-sm-10">
              <input type="text" name="smartpost_sort_order" value="<?php echo $smartpost_sort_order ?>" placeholder="<?php echo $entry_sort_order ?>" id="input-sort-order" class="form-control" />
            </div>
          </div>

   </div>
   <div class="tab-pane" id="tab-hinnasto">

          <div class="table-responsive">
                <table id="ihinnasto" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left col-sm-2"><?php echo $column_kg ?></td>
                      <td class="text-left col-sm-8"><?php echo $column_price ?></td>
                      <td class="text-left col-sm-2"></td>
                    </tr>
                  </thead>
                  <tbody>
          <?php $row = 0 ?>
          <?php if ( $smartpost_hinnasto ){?>
            <?php foreach( $smartpost_hinnasto as $hinta  ){?>
             <tr id="row<?php echo $row ?>">
                    <td class="text-left"> <input type="text" name="smartpost_hinnasto[<?php echo $row ?>][kg]" value="<?php echo $hinta['kg'] ?>" class="form-control" /></td>
                    <td><input type="text" name="smartpost_hinnasto[<?php echo $row ?>][price]" value="<?php echo $hinta['price'] ?>" class="form-control" /></td>
                    <td class="text-left"><button type="button" onclick="$('#row<?php echo $row ?>').remove()" data-toggle="tooltip" title="<?php echo $button_remove ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td></tr>           
                   <?php if (isset($hinta['error'])){?>
                   <tr><td></td><td> <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $hinta['error'] ?>
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                     </div></td><td></td></tr>
                   <?php } ?>
            <?php $row++; ?>
            <?php } ?>
          <?php } ?>
            </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td></td>
                      <td class="text-left"><button type="button" id="button-add" data-toggle="tooltip" title="<?php echo $button_weight_add ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                    </tfoot>
                  </table>
         </div>

            <script type="text/javascript"><!--
              var row = <?php echo $row ?>;
              $('#button-add').click(function(){
              html  = '<tr id="row' + row + '">';
              html += '  <td class="text-right"><input type="text" name="smartpost_hinnasto[' + row + '][kg]" value="" placeholder="<?php echo $column_kg ?>" class="form-control" /></td>';
              html += '  <td class="text-right"><input type="text" name="smartpost_hinnasto[' + row + '][price]" value="" placeholder="<?php echo $column_price ?>" class="form-control" /></td>';
              html += '  <td class="text-left"><button type="button" onclick="$(\'#row' + row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
              html += '</tr>';

              $('#tab-hinnasto tbody').append(html);

                row++;
              });
            //--></script>
  </div>

    </form>
  </div>
</div>
</div>


<script type="text/javascript"><!--
$('#tabs a').tabs();
//--></script> 
<?php echo $footer ?> 
