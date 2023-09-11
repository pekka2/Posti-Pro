<?php echo $header ?><?php echo $column_left ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-shipping" data-toggle="tooltip" title="<?php echo $button_save ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel ?>" data-toggle="tooltip" title="<?php echo $button_cancel ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title ?></h1>
      <ul class="breadcrumb">
        <?php foreach( $breadcrumbs as $breadcrumb ){?>
        <li><a href="<?php echo $breadcrumb['href'] ?>"><?php echo $breadcrumb['text'] ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ( $error_warning ){?>
    <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="form-shipping" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general ?></a></li>
            <li><a href="#tab-hinnasto" data-toggle="tab"><?php echo $tab_hinnasto ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
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
</div>
<?php echo $footer ?> 
