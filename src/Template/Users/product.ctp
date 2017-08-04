<script type="text/javascript">

    $(document).ready(function () {
        // waitingDialog.show();

        $('.regular').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });

</script>






<form action="<?php echo $this->request->webroot ?>orders/addschedule" method="post">
    <?php foreach ($days as $d) { ?>
        <div class="table_sec">

            <div class="globel_headding">
                <div class="container">
                    <div class="table_head">
                        <h1><?php echo $d['name']; ?></h1>
                        <b></b>
                    </div>
                </div>
            </div>

            <div class="product_carousel">
                <div class="container">


                    <?php if ($userplans == 1) { ?>
                        <div class="col-sm-12">
                            <div class="table_subhead">
                                <h1>Dinner</h1>
                                <b></b>
                            </div>
                            <section class="regular slider">
                                <?php foreach ($d['products'] as $product) { ?> 
                                    <div class="table_item">
                                        <img src="<?php echo $this->request->webroot ?>product/<?php echo $product['image']; ?>" alt="Image" style="height:200px;">
                                        <div class="thumb_chk">
                                            <span class="label label-success" id="alergy-<?php echo $product['id']; ?>">Check Allergens</span> 
                                            <input type="checkbox" style="display:none" name="alergy-dinner-<?php echo $d['name']; ?>" value="" id="alergyinput-<?php echo $product['id']; ?>"/>
                                            <div class="radio_outer">
                                                <div class="radio radio-danger right_radio">
                                                    <input type="radio" name="food[dinner-<?php echo $d['name']; ?>]" id="radio<?php echo $product['id']; ?>" value="<?php echo $product['id']; ?>">
                                                    <label for="radio<?php echo $product['id']; ?>"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="thumb_sec">
                                            <div class="thumb-left"><?php echo $product['name']; ?></div>
                                            <div class="thumb-right"><?php echo $product['calorie']; ?> Calories</div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </section>
                        </div>
                    <?php } ?>
                    <?php if ($userplans == 2 || $userplans == 3) { ?>
                        <div class="col-sm-12">
                            <div class="table_subhead">
                                <h1>Lunch</h1>
                                <b></b>
                            </div>


                            <section class="regular slider">
                                <?php
                                foreach ($d['products'] as $product) {
                                    if ($product['category_id'] == 8) {
                                        ?> 
                                        <div class="table_item">
                                            <img src="<?php echo $this->request->webroot ?>product/<?php echo $product['image']; ?>" alt="Image" style="height:200px;">
                                            <div class="thumb_chk">

                                                <input style="display:none" type="checkbox" name="alergy-lunch-<?php echo $d['name']; ?>" value="" id="alergyinput-<?php echo $product['id']; ?>"/>
                                                <div class="radio_outer">
                                                    <div class="radio radio-danger right_radio">
                                                        <input type="radio" name="food[lunch-<?php echo $d['name']; ?>]" id="radio<?php echo $product['id']; ?>" value="<?php echo $product['id']; ?>">
                                                        <label for="radio<?php echo $product['id']; ?>"></label>
                                                    </div>
                                                </div>
                                                <span class="label label-success" id="alergy-<?php echo $product['id']; ?>">Check Allergens</span> 
                                                <?php if ($userplans == 3) { ?>
                                                    <input type="checkbox" style="display:none" name="cfood[lunch-<?php echo $d['name']; ?>]" value="" id="cfood-<?php echo $product['id']; ?>"/>

                                                    <span class="cfood" id="cfood-<?php echo $product['id']; ?>">Customize Food</span> 
                                                <?php } ?>
                                            </div>
                                            <div class="thumb_sec">
                                                <div class="thumb-left"><?php echo $product['name']; ?></div>
                                                <div class="thumb-right"><?php echo $product['calorie']; ?> Calories</div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </section>
                        </div>
                        <div class="col-sm-12">
                            <div class="table_subhead">
                                <h1>Dinner</h1>
                                <b></b>
                            </div>
                            <section class="regular slider">
                                <?php
                                foreach ($d['products'] as $product) {
                                    if ($product['category_id'] == 9) {
                                        ?> 
                                        <div class="table_item">
                                            <img src="<?php echo $this->request->webroot ?>product/<?php echo $product['image']; ?>" alt="Image" style="height:200px;">
                                            <div class="thumb_chk">

                                                <input type="checkbox" style="display:none" name="alergy-dinner-<?php echo $d['name']; ?>" value="" id="alergyinput-<?php echo $product['id']; ?>"/>
                                                <div class="radio_outer">
                                                    <div class="radio radio-danger right_radio">
                                                        <input type="radio" name="food[dinner-<?php echo $d['name']; ?>]" id="radio<?php echo $product['id']; ?>" value="<?php echo $product['id']; ?>">
                                                        <label for="radio<?php echo $product['id']; ?>"></label>
                                                    </div>
                                                </div>
                                                <span class="label label-success" id="alergy-<?php echo $product['id']; ?>">Check Allergens</span>
                                                <?php if ($userplans == 3) { ?>
                                                    <input type="checkbox" style="display:none" name="cfood[dinner-<?php echo $d['name']; ?>]" value="" id="cfood-<?php echo $product['id']; ?>"/>


                                                    <span class="cfood" id="cfood-<?php echo $product['id']; ?>">Customize Food</span> 
                                                <?php } ?>
                                            </div>
                                            <div class="thumb_sec">
                                                <div class="thumb-left"><?php echo $product['name']; ?></div>
                                                <div class="thumb-right"><?php echo $product['calorie']; ?> Calories</div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </section>                   
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div> 
    <?php } ?>









    <!------Address Sections---------------->


    <div class="table_sec">
        <div class="address_section">
            <h1 class="select_add">Select your address</h1>
            <div class="container">     

                <section class="regular slider address_bx">
                    <?php foreach ($address as $addrs) { ?>
                        <div class="table_item_box">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="addres_ftrsec">
                                <tr>
                                    <th><?php echo $addrs['addresstype']; ?></th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td> <?php echo $addrs['first_name'] . " " . $addrs['last_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $addrs['address1']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>  <?php echo $addrs['country']; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>  <?php echo $addrs['city']; ?>  </td>
                                    </tr>
                                    <tr>
                                        <td> <?php echo $addrs['zip']; ?>  </td>
                                    </tr>
                                </tbody></table>


                            <div class="thumb_chk">
                                <div class="radio_outer">
                                    <div class="radio radio-danger right_radio">
                                        <input type="radio" name="address" id="radio21<?php echo $addrs['id']; ?>" value="<?php echo $addrs['id']; ?>" required>
                                        <label for="radio21<?php echo $addrs['id']; ?>"></label>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    <?php } ?>
                </section>

                <a href="<?php echo $this->request->webroot ?>addresses"  class="btn btn-success green_btn pull-left" target="_blank">Add Delivery Address</a>              

                <input name="submit" value="Place Order Shedule" type="submit" class="btn btn-success green_btn pull-right">

            </div>
        </div>

</form>   
</div>

<!-------------------Address Section----------------------->




</div>
<div id="myModal333" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="poup_title">Alergy list</h1>
            </div>
            <div class="modal-body">
                <div class="subscipion_inners">
                    <div class="col-md-12 col-lg-12">



                    </div>
                    <div class="col-md-12 col-lg-12" id="333">

                    </div>
<!--                    <br/>  <input type="button" name="submit" id="addalergy" value="Add Alergy"/>-->
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<div id="myModal222" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="poup_title">Select Associated Product</h1>
            </div>
            <div class="modal-body">
                <div class="subscipion_inners">
                    <div class="col-md-12 col-lg-12">



                    </div>
                    <div class="col-md-12 col-lg-12" id="222">

                    </div>
                    <input type="button" name="submit" id="addassopro" value="Add Associate Product"/>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.label-success').on('click', function () {
        var val = $(this).attr("id");
        $.post('<?php echo $base_url; ?>/products/showalergy.json', {'id': val}, function (d) {
            if (d.data.isdata == 1) {
                //var localdata= localStorage.getItem(val);               
                var html = '<div>';
                for (i in d.data.data) {

                    //html += '<p><input type="checkbox"  value="' + d.data.data[i].id + '" name='+val+'></p>';

                    html += '<p>' + d.data.data[i].name + '</p>';
                    html += '<p>' + d.data.data[i].about + '</p>';
                }
                html += '</div>';
                // $("#radio"+val.split('-')[1]).attr("checked", "checked");             
//                            /console.log(html);
                $("#myModal333").modal('show');
                $("#333").html(html);

            }
        });
    });


    $('#addalergy').on('click', function () {
        var val = [];
        $('#333 input[type=checkbox]:checked').each(function (i) {
            val[i] = $(this).val();
        });
        var name = $('#333 input[type=checkbox]:checked').attr('name');
        var alname = name.split('-');
        console.log(val);
        $("#alergyinput-" + alname[1]).attr("checked", "checked");
        $al_name = $("#alergyinput-" + alname[1]).attr('name');
        $("input[name*='" + $al_name + "']").val('');
        $("#alergyinput-" + alname[1]).val(JSON.stringify(val));
        localStorage.setItem(alname[1], val);
        $("#myModal333").modal('hide');
        //alergyinput-
    });
    
    $('.cfood').on('click', function () {
    var val = $(this).attr("id");
            $.post('<?php echo $base_url; ?>/products/showalergy.json', {'id': val}, function (d) {
            if (d.data.isdata == 1) {
            //var localdata= localStorage.getItem(val);               
            var html = '<div class="associate_model">';
                    for (i in d.data.data) {
            html += '<div class="modal-head"><h1 style="text-align:center; margin-bottom:15px; font-weight:700;">' + d.data.data[i].name + '</h1></div>';
                    for (j in d.data.data[i].asso_products) {

            html += '<div class="col-sm-4 asso_list">';
                    html += '<span class="check_box"><input type="radio"  value="' + d.data.data[i].asso_products[j].id + '" name=' + val + '-'+d.data.data[i].name+'></span>';
                    html += '<div class="asso_pro"><img src=<?php echo $base_url; ?>/assoproduct/' + d.data.data[i].asso_products[j].image + ' style="width:100px"></div>';
                    html += '<h4>' + d.data.data[i].asso_products[j].name + '</h4>';
                    html += '<p>' + d.data.data[i].asso_products[j].description + '</p>';
                    html += '</div>';
            }
            }
            html += '</div>';
                    $("#radio" + val.split('-')[1]).attr("checked", "checked");
//                            /console.log(html);
                    $("#myModal222").modal('show');
                    $("#222").html(html);
            }
            });
        });
            $('#addassopro').on('click', function () {
             var val = [];
            $('#222 input[type=radio]:checked').each(function (i) {
               val[i] = $(this).val();
            });
            console.log(val);
            var name = $('#222 input[type=radio]:checked').attr('name');
            var alname = name.split('-');
            $("#cfood-" + alname[1]).attr("checked", "checked");
            $al_name = $("#cfood-" + alname[1]).attr('name');
            $("input[name*='" + $al_name + "']").val('');
            $("#cfood-" + alname[1]).val(JSON.stringify(val));
            localStorage.setItem(alname[1], val);
            $("#myModal222").modal('hide');
            //alergyinput-
    });


</script>