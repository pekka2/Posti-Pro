<?php echo $header ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-shipping" data-toggle="tooltip" title="<?php echo $button_save ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel ?>" data-toggle="tooltip" title="<?php echo $button_cancel ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title ?></h1>
      <ul class="breadcrumb">
        <?php foreach( $breadcrumbs as $breadcrumb ){ ?>
        <li><a href="<?php echo $breadcrumb['href'] ?>"><?php echo $breadcrumb['text'] ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
   <?php if( $error_warning ){ ?>
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
          <div id="tabs" class="htabs">
           <a href="#tab-general" data-toggle="tab"><?php echo $tab_general ?></a>
            <a href="#tab-hinnasto" data-toggle="tab"><?php echo $tab_hinnasto ?></a>
            <a href="#tab-hinnasto1" data-toggle="tab"><?php echo $tab_hinnasto_2 ?></a>
            <a href="#tab-hinnasto2" data-toggle="tab"><?php echo $tab_hinnasto_3 ?></a>
            <a href="#tab-hinnasto3" data-toggle="tab"><?php echo $tab_hinnasto_4 ?></a>
            <a href="#tab-hinnasto4" data-toggle="tab"><?php echo $tab_hinnasto_5 ?></a>
          </div>


          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status ?></label>
            <div class="col-sm-10">
              <select name="posti_pro_status" id="input-status" class="form-control">
               <?php if( $posti_pro_status ){ ?>
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
              <select name="posti_pro_tax_class_id" id="input-tax-class" class="form-control">
                <option value="0"><?php echo $text_none ?></option>
                <?php foreach( $tax_classes as $tax_class ){ ?>
               <?php if( $tax_class['tax_class_id'] == $posti_pro_tax_class_id ){ ?>
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
              <select name="posti_pro_weight_class_id" id="input-weight-class" class="form-control">
                <option value="0"><?php echo $text_none ?></option>
                <?php foreach( $weight_classes as $weight_class ){ ?>
               <?php if($weight_class['weight_class_id'] == $posti_pro_weight_class_id ){ ?>
                <option value="<?php echo $weight_class['weight_class_id'] ?>" selected="selected"><?php echo $weight_class['title'] ?></option>
                <?php } else { ?>
                <option value="<?php echo $weight_class['weight_class_id'] ?>"><?php echo $weight_class['title'] ?></option>
               <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-weight-class"><?php echo $entry_length_class; ?></label>
            <div class="col-sm-10">
              <select name="posti_pro_length_class_id" id="input-weight-class" class="form-control">
                <option value="0"><?php echo $text_none ?></option>
                <?php foreach( $length_classes as $length_class ){ ?>
               <?php if( $length_class['length_class_id'] == $posti_pro_length_class_id ){ ?>
                <option value="<?php echo $length_class['length_class_id']; ?>" selected="selected"><?php echo $length_class['title']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $length_class['length_class_id']; ?>"><?php echo $length_class['title']; ?></option>
               <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone ?></label>
            <div class="col-sm-10">
              <select name="posti_pro_geo_zone_id" id="input-geo-zone" class="form-control">
                <option value="0"><?php echo $text_all_zones ?></option>
                <?php foreach( $geo_zones as $geo_zone ){ ?>
               <?php if( $geo_zone['geo_zone_id'] == $posti_pro_geo_zone_id ){ ?>
                <option value="<?php echo $geo_zone['geo_zone_id'] ?>" selected="selected"><?php echo $geo_zone['name'] ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id'] ?>"><?php echo $geo_zone['name'] ?></option>
               <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-kotijakelu"><?php echo $entry_kotijakelu; ?></label>
            <div class="col-sm-10">
              <select name="posti_pro_kotijakelu_status" id="input-kotijakelu" class="form-control">
                <?php if($posti_pro_kotijakelu_status){?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else {?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-koti-price"><span data-toggle="tooltip" title="<?php echo $help_kotijakelu_price;?>"><?php echo $entry_kotijakelu_price;?></span></label>
            <div class="col-sm-10">
              <input type="text" name="posti_pro_kotijakelu_price" value="<?php echo $posti_pro_kotijakelu_price;?>" placeholder="<?php echo $entry_kotijakelu_price;?>" id="input-koti-price" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-free-cargo"><?php echo $entry_free_cargo ?></label>
            <div class="col-sm-10">
              <select name="posti_pro_free_cargo" id="input-free-cargo" class="form-control">
               <?php if( $posti_pro_free_cargo ){ ?>
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
              <select name="posti_pro_discount_cargo" id="input-discount-cargo" class="form-control">
               <?php if( $posti_pro_discount_cargo ){ ?>
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
            <label class="col-sm-2 control-label" for="input-discount-oreign_countries"><?php echo $entry_discount_foreign_countries ?></label>
            <div class="col-sm-10">
              <select name="posti_pro_discount_foreign_countries" id="input-discount-foreign_countries" class="form-control">
               <?php if( $posti_pro_discount_foreign_countries ){ ?>
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
              <input type="text" name="posti_pro_cargo_sum" value="<?php echo $posti_pro_cargo_sum ?>" placeholder="<?php echo $entry_cargo_sum ?>" id="input-cargo-sum" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-discount-cargo-percent"><?php echo $entry_discount_cargo_percent ?></label>
            <div class="col-sm-10">
              <input type="text" name="posti_pro_discount_cargo_percent" value="<?php echo $posti_pro_discount_cargo_percent ?>" placeholder="<?php echo $entry_discount_cargo_percent ?>" id="input-discount-cargo-percent" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-foreign-countries-sum"><?php echo $entry_cargo_foreign_countries_sum ?></label>
            <div class="col-sm-10">
              <input type="text" name="posti_pro_cargo_foreign_countries_sum" value="<?php echo $posti_pro_cargo_foreign_countries_sum ?>" placeholder="<?php echo $entry_cargo_foreign_countries_sum ?>" id="input-foreign-countries-sum" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-discount-cargo-percent"><?php echo $entry_discount_foreign_countries_percent ?></label>
            <div class="col-sm-10">
              <input type="text" name="posti_pro_discount_foreign_countries_percent" value="<?php echo $posti_pro_discount_foreign_countries_percent ?>" placeholder="<?php echo $entry_discount_foreign_countries_percent ?>" id="input-discount-cargo-percent" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-top"><?php echo $entry_top ?></label>
            <div class="col-sm-10">
              <input type="text" name="posti_pro_top" value="<?php echo $posti_pro_top ?>" placeholder="<?php echo $entry_top ?>" id="input-top" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order ?></label>
            <div class="col-sm-10">
              <input type="text" name="posti_pro_sort_order" value="<?php echo $posti_pro_sort_order ?>" placeholder="<?php echo $entry_sort_order ?>" id="input-sort-order" class="form-control" />
            </div>
          </div>
            </div>
          <div id="tab-hinnasto">   
                <table id="hinnasto" class="list">
                  <thead>
                    <tr>
                      <td class="text-left col-sm-2"><?php echo $column_kg ?></td>
                      <td class="text-left col-sm-8"><?php echo $column_price ?></td>
                      <td class="text-left col-sm-2"></td>
                    </tr>
                  </thead>
                  <tbody>
          <?php $row = 0 ?>
         <?php if( $posti_pro_hinnasto ){ ?>
            <?php foreach(  $posti_pro_hinnasto as $hinta ){ ?>
             <tr id="row<?php echo $row ?>">
                    <td class="text-left"> <input type="text" name="posti_pro_hinnasto[<?php echo $row ?>][kg]" value="<?php echo $hinta['kg'] ?>" class="form-control" /></td>
                    <td><input type="text" name="posti_pro_hinnasto[<?php echo $row ?>][price]" value="<?php echo $hinta['price'] ?>" class="form-control" /></td>
                    <td class="text-left"><button type="button" onclick="$('#row<?php echo $row ?>').remove()" data-toggle="tooltip" title="<?php echo $button_remove ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td></tr>         
                  <?php if(isset($hinta['error']) ){ ?>
                   <tr><td></td><td> <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $hinta['error'] ?>
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                     </div></td><td></td></tr>
                  <?php }
            $row++;
              }
           } ?>
            </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td></td>
                      <td class="text-left"><button type="button" id="button-add" data-toggle="tooltip" title="<?php echo $button_weight_add ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                    </tfoot>
                  </table>

  <script type="text/javascript"><!--
   var row = <?php echo $row ?>;
  $('#button-add').click(function(){
  html  = '<tr id="row' + row + '">';
    html += '  <td class="text-right"><input type="text" name="posti_pro_hinnasto[' + row + '][kg]" value="" placeholder="<?php echo $column_kg ?>" class="form-control" /></td>';
    html += '  <td class="text-right"><input type="text" name="posti_pro_hinnasto[' + row + '][price]" value="" placeholder="<?php echo $column_price ?>" class="form-control" /></td>';
  html += '  <td class="text-left"><button type="button" onclick="$(\'#row' + row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  $('#tab-hinnasto tbody').append(html);

  row++;
  });
//--></script>
          </div>
          <div id="tab-hinnasto1">
          <?php echo $text_hinnasto_2_kuvaus ?>
                <table id="hinnasto-2"  class="list">
                  <thead>
                    <tr>
                      <td class="text-left col-sm-2"><?php echo $column_kg ?></td>
                      <td class="text-left col-sm-8"><?php echo $column_price ?></td>
                      <td class="text-left col-sm-2"></td>
                    </tr>
                  </thead>
                  <tbody>
          <?php $row2 = 0 ?>
         <?php if( $posti_pro_hinnasto_countrygroup_1 ){ ?>
            <?php foreach( $posti_pro_hinnasto_countrygroup_1 as $hinta2 ){ ?>
             <tr id="row2-<?php echo $row2 ?>">
                    <td class="text-left"> <input type="text" name="posti_pro_hinnasto_countrygroup_1[<?php echo $row2 ?>][kg]" value="<?php echo $hinta2['kg'] ?>" class="form-control" /></td>
                    <td><input type="text" name="posti_pro_hinnasto_countrygroup_1[<?php echo $row2 ?>][price]" value="<?php echo $hinta2['price'] ?>" class="form-control" /></td>
                    <td class="text-left"><button type="button" onclick="$('#row2-<?php echo $row2 ?>').remove()" data-toggle="tooltip" title="<?php echo $button_remove ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td></tr>         
                  <?php if(isset($hinta2['error'])){ ?>
                   <tr><td></td><td> <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $hinta2['error'] ?>
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                     </div></td><td></td></tr>
                  <?php } ?>   
            <?php $row2++; ?>
            <?php } ?>
         <?php } ?>
            </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td></td>
                      <td class="text-left"><button type="button" id="button-posti" data-toggle="tooltip" title="<?php echo $button_weight_add ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                    </tfoot>
                  </table>

  <script type="text/javascript"><!--
   var row2 = <?php echo $row2 ?>;
  $('#button-posti').click(function(){
  html2  = '<tr id="row2-' + row2 + '">';
  html2 += '  <td class="text-right"><input type="text" name="posti_pro_hinnasto_countrygroup_1[' + row2 + '][kg]" value="" placeholder="<?php echo $column_kg ?>" class="form-control" /></td>';
  html2 += '  <td class="text-right"><input type="text" name="posti_pro_hinnasto_countrygroup_1[' + row2 + '][price]" value="" placeholder="<?php echo $column_price ?>" class="form-control" /></td>';
  html2 += '  <td class="text-left"><button type="button" onclick="$(\'#row2-' + row2 + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html2 += '</tr>';

  $('#tab-hinnasto1 tbody').append(html2);

    row2++;
  });
//--></script>
          </div>
          <div id="tab-hinnasto2">
          <?php echo $text_hinnasto_3_kuvaus ?>
                <table id="hinnasto-2"  class="list">
                  <thead>
                    <tr>
                      <td class="text-left col-sm-2"><?php echo $column_kg ?></td>
                      <td class="text-left col-sm-8"><?php echo $column_price ?></td>
                      <td class="text-left col-sm-2"></td>
                    </tr>
                  </thead>
                  <tbody>
          <?php $row3 = 0 ?>
         <?php if( $posti_pro_hinnasto_countrygroup_2 ){ ?>
            <?php foreach( $posti_pro_hinnasto_countrygroup_2 as  $hinta3 ){ ?>
             <tr id="row3-<?php echo $row3 ?>">
                    <td class="text-left"> <input type="text" name="posti_pro_hinnasto_countrygroup_2[<?php echo $row3 ?>][kg]" value="<?php echo $hinta3['kg'] ?>" class="form-control" /></td>
                    <td><input type="text" name="posti_pro_hinnasto_countrygroup_2[<?php echo $row3 ?>][price]" value="<?php echo $hinta3['price'] ?>" class="form-control" /></td>
                    <td class="text-left"><button type="button" onclick="$('#row3-<?php echo $row3 ?>').remove()" data-toggle="tooltip" title="<?php echo $button_remove ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td></tr>         
                  <?php if(isset($hinta3['error'])){ ?>
                   <tr><td></td><td> <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $hinta3['error'] ?>
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                     </div></td><td></td></tr>
                  <?php } ?>
            <?php $row3++; ?>
            <?php } ?>
         <?php } ?>
            </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td></td>
                      <td class="text-left"><button type="button" id="button-posti2" data-toggle="tooltip" title="<?php echo $button_weight_add ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                    </tfoot>
                  </table>

  <script type="text/javascript"><!--
   var row3 = <?php echo $row3 ?>;
  $('#button-posti2').click(function(){
  html3  = '<tr id="row3-' + row3 + '">';
  html3 += '  <td class="text-right"><input type="text" name="posti_pro_hinnasto_countrygroup_2[' + row3 + '][kg]" value="" placeholder="<?php echo $column_kg ?>" class="form-control" /></td>';
  html3 += '  <td class="text-right"><input type="text" name="posti_pro_hinnasto_countrygroup_2[' + row3 + '][price]" value="" placeholder="<?php echo $column_price ?>" class="form-control" /></td>';
  html3 += '  <td class="text-left"><button type="button" onclick="$(\'#row3-' + row3 + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html3 += '</tr>';

  $('#tab-hinnasto2 tbody').append(html3);

    row3++;
  });
//--></script>
          </div>
          <div id="tab-hinnasto3">
          <?php echo $text_hinnasto_4_kuvaus ?>
                <table id="hinnasto-2"  class="list">
                  <thead>
                    <tr>
                      <td class="text-left col-sm-2"><?php echo $column_kg ?></td>
                      <td class="text-left col-sm-8"><?php echo $column_price ?></td>
                      <td class="text-left col-sm-2"></td>
                    </tr>
                  </thead>
                  <tbody>
          <?php $row4 = 0 ?>
         <?php if( $posti_pro_hinnasto_countrygroup_3 ){ ?>
            <?php foreach( $posti_pro_hinnasto_countrygroup_3 as $hinta4 ){ ?>
             <tr id="row4-<?php echo $row4 ?>">
                    <td class="text-left"> <input type="text" name="posti_pro_hinnasto_countrygroup_3[<?php echo $row4 ?>][kg]" value="<?php echo $hinta4['kg'] ?>" class="form-control" /></td>
                    <td><input type="text" name="posti_pro_hinnasto_countrygroup_3[<?php echo $row4 ?>][price]" value="<?php echo $hinta4['price'] ?>" class="form-control" /></td>
                    <td class="text-left"><button type="button" onclick="$('#row4-<?php echo $row4 ?>').remove()" data-toggle="tooltip" title="<?php echo $button_remove ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td></tr>         
                  <?php if(isset($hinta4['error'])){ ?>
                   <tr><td></td><td> <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $hinta4['error'] ?>
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                     </div></td><td></td></tr>
                  <?php } ?>
            <?php $row4++; ?>
            <?php } ?>
         <?php } ?>
            </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td></td>
                      <td class="text-left"><button type="button" id="button-posti3" data-toggle="tooltip" title="<?php echo $button_weight_add ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                    </tfoot>
                  </table>

  <script type="text/javascript"><!--
   var row4 = <?php echo $row4 ?>;
  $('#button-posti3').click(function(){
  html4  = '<tr id="row4-' + row4 + '">';
  html4 += '  <td class="text-right"><input type="text" name="posti_pro_hinnasto_countrygroup_3[' + row4 + '][kg]" value="" placeholder="<?php echo $column_kg ?>" class="form-control" /></td>';
  html4 += '  <td class="text-right"><input type="text" name="posti_pro_hinnasto_countrygroup_3[' + row4 + '][price]" value="" placeholder="<?php echo $column_price ?>" class="form-control" /></td>';
  html4 += '  <td class="text-left"><button type="button" onclick="$(\'#row4-' + row4 + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html4 += '</tr>';

  $('#tab-hinnasto3 tbody').append(html4);

    row4++;
  });
//--></script>
          </div>
          <div id="tab-hinnasto4">
          <?php echo $text_hinnasto_5_kuvaus ?>
                <table id="hinnasto-2"  class="list">
                  <thead>
                    <tr>
                      <td class="text-left col-sm-2"><?php echo $column_kg ?></td>
                      <td class="text-left col-sm-8"><?php echo $column_price ?></td>
                      <td class="text-left col-sm-2"></td>
                    </tr>
                  </thead>
                  <tbody>
          <?php $row5 = 0 ?>
         <?php if( $posti_pro_hinnasto_countrygroup_4 ){ ?>
            <?php foreach( $posti_pro_hinnasto_countrygroup_4 as $hinta5 ){ ?>
             <tr id="row5-<?php echo $row5 ?>">
                    <td class="text-left"> <input type="text" name="posti_pro_hinnasto_countrygroup_4[<?php echo $row5 ?>][kg]" value="<?php echo $hinta5['kg'] ?>" class="form-control" /></td>
                    <td><input type="text" name="posti_pro_hinnasto_countrygroup_4[<?php echo $row5 ?>][price]" value="<?php echo $hinta5['price'] ?>" class="form-control" /></td>
                    <td class="text-left"><button type="button" onclick="$('#row5-<?php echo $row5 ?>').remove()" data-toggle="tooltip" title="<?php echo $button_remove ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td></tr>         
                  <?php if(isset($hinta5['error'])){ ?>
                   <tr><td></td><td> <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $hinta5['error'] ?>
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                     </div></td><td></td></tr>
                  <?php } ?>   
            <?php $row5++; ?>
            <?php } ?>
         <?php } ?>
            </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td></td>
                      <td class="text-left"><button type="button" id="button-posti4" data-toggle="tooltip" title="<?php echo $button_weight_add ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                    </tfoot>
                  </table>

  <script type="text/javascript"><!--
   var row5 = <?php echo $row5 ?>;
  $('#button-posti4').click(function(){
  html5  = '<tr id="row5-' + row5 + '">';
  html5 += '  <td class="text-right"><input type="text" name="posti_pro_hinnasto_countrygroup_4[' + row5 + '][kg]" value="" placeholder="<?php echo $column_kg ?>" class="form-control" /></td>';
  html5 += '  <td class="text-right"><input type="text" name="posti_pro_hinnasto_countrygroup_4[' + row5 + '][price]" value="" placeholder="<?php echo $column_price ?>" class="form-control" /></td>';
  html5 += '  <td class="text-left"><button type="button" onclick="$(\'#row5-' + row5 + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html5 += '</tr>';

  $('#tab-hinnasto4 tbody').append(html5);

    row5++;
  });
//--></script>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript"><!--
$('#tabs a').tabs();
//--></script> 
<?php echo $footer ?> 
