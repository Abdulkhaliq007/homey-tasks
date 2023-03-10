<?php
global $homey_local, $homey_booking_type, $experience_meta_data;
$hide_fields_for_experience = $hide_fields = homey_option('experience_add_hide_fields');

$instant_booking = isset($experience_meta_data['homey_instant_booking'][0]) ? $experience_meta_data['homey_instant_booking'][0] : 0;// homey_get_field_meta('instant_booking');

$day_date_price = isset($experience_meta_data['homey_day_date_price'][0]) ? $experience_meta_data['homey_day_date_price'][0] : 0; //homey_get_field_meta('day_date_price');
$night_price = isset($experience_meta_data['homey_night_price'][0]) ? $experience_meta_data['homey_night_price'][0] : 0; //homey_get_field_meta('night_price');

if($homey_booking_type == 'per_day_date') {
    $fees_label = homey_option('ad_day_date_text');
}elseif($homey_booking_type == 'per_hour') {
    $fees_label = homey_option('ad_hourly_text');
} else if($homey_booking_type == 'per_week') {
    $fees_label = homey_option('ad_weekly_text');
} else if($homey_booking_type == 'per_month') {
    $fees_label = homey_option('ad_monthly_text');
} else {
    $fees_label = homey_option('ad_daily_text');
}

$price_label = $price_plac = '';
if($homey_booking_type == 'per_day_date') {
    $price_label = homey_option('ad_day_date_label');
    $price_plac = homey_option('ad_day_date_plac');
}elseif($homey_booking_type == 'per_week') {
    $price_label = homey_option('ad_weekly_label');
    $price_plac = homey_option('ad_weekly_plac');
} else if($homey_booking_type == 'per_month') {
    $price_label = homey_option('ad_monthly_label');
    $price_plac = homey_option('ad_monthly_plac');
} else {
    $price_label = homey_option('ad_nightly_label');
    $price_plac = homey_option('ad_nightly_plac');
}

if(@$hide_fields['price_postfix'] != 1) {
    $instance_classes = 'col-sm-12 col-xs-12';
    $postfix_classes = 'col-sm-6 col-xs-12';
} else {
    $instance_classes = 'col-sm-6 col-xs-12';
    $postfix_classes = 'col-sm-6 col-xs-12';
}

$class = '';
if(isset($_GET['tab']) && $_GET['tab'] == 'pricing') {
    $class = 'in active';
}
?>
<div id="pricing-tab" class="tab-pane fade <?php echo esc_attr($class);?>">
    <!--step information-->
    <div class="block">
        <div class="block-title">
            <div class="block-left">
                <h2 class="title"><?php echo esc_html(homey_option('ad_pricing_label')); ?></h2>
            </div><!-- block-left -->
        </div>
        <div class="block-body">
            <div class="row">

                <?php if($hide_fields['experience_instant_booking'] != 1) { ?>
                    <div class="<?php echo esc_attr($instance_classes); ?>">
                        <div class="form-group">
                            <label><?php echo esc_attr(homey_option('ad_ins_booking_label')); ?></label>
                            <label class="control control--checkbox radio-tab"><?php echo esc_attr(homey_option('ad_ins_booking_des')); ?>
                                <input type="checkbox" <?php checked( $instant_booking, 1 ); ?> name="instant_booking">
                                <span class="control__indicator"></span>
                                <span class="radio-tab-inner"></span>
                            </label>
                        </div>
                    </div>
                <?php } ?>

                <?php if($hide_fields['experience_night_price'] != 1) { ?>
                    <?php if($homey_booking_type == 'per_day_date') { ?>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="night-price"><?php echo esc_html__('Price Per Day', 'homey').homey_req('experience_night_price'); ?></label>
                                <input type="text" value="<?php echo $day_date_price; ?>" name="day_date_price" class="form-control" <?php homey_required('experience_night_price'); ?> id="day_date_price" placeholder="<?php echo esc_html__('Enter price for 1 day', 'homey'); ?>">
                            </div>
                        </div>
                    <?php } elseif($homey_booking_type == 'per_hour') { ?>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="night-price"><?php echo esc_html__('Price Per Hour', 'homey').homey_req('experience_night_price'); ?></label>
                                <input type="text"  value="<?php echo $night_price; ?>"  data-input-title="<?php echo esc_html__('Price Per Hour', 'homey'); ?>" name="hour_price" class="form-control" <?php homey_required('experience_night_price'); ?> id="hour_price" placeholder="<?php echo esc_html__('Enter price for 1 hour', 'homey'); ?>">
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="night-price"><?php echo esc_attr($price_label).homey_req('experience_night_price'); ?></label>
                                <input type="text"  value="<?php echo $night_price; ?>"  data-input-title="<?php echo esc_html__('Price Per Night', 'homey'); ?>" name="night_price" class="form-control" <?php homey_required('experience_night_price'); ?> id="night_price" placeholder="<?php echo esc_attr($price_plac); ?>">
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>


                <?php if($hide_fields['experience_price_postfix'] != 1) { ?>
                    <div class="<?php echo esc_attr($postfix_classes); ?>">
                        <div class="form-group">
                            <label for="price_postfix"><?php echo esc_attr(homey_option('ad_price_postfix_label')); ?></label>
                            <input type="text" value="<?php echo $experience_meta_data['homey_price_postfix'][0]?>" name="price_postfix" class="form-control" id="price_postfix" placeholder="<?php echo esc_attr(homey_option('ad_price_postfix_plac')); ?>">
                        </div>
                    </div>
                <?php } ?>

            </div>
            <div class="row">

                <?php if(1==2 && $hide_fields['experience_weekends_price'] != 1) { ?>
                    <?php if($homey_booking_type == 'per_day_date') { ?>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="weekends_price"><?php echo esc_attr(homey_option('ad_weekends_label')).homey_req('experience_weekends_price'); ?></label>
                                <input type="text" name="day_date_weekends_price" class="form-control" <?php homey_required('experience_weekends_price'); ?> id="day_date_weekends_price" placeholder="<?php echo esc_html__('Enter per day price for weekends', 'homey'); ?>">
                            </div>
                        </div>
                    <?php }elseif($homey_booking_type == 'per_hour') { ?>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="weekends_price"><?php echo esc_attr(homey_option('ad_weekends_label')).homey_req('experience_weekends_price'); ?></label>
                                <input type="text" name="hourly_weekends_price" class="form-control" <?php homey_required('experience_weekends_price'); ?> id="hourly_weekends_price" placeholder="<?php echo esc_html__('Enter per hour price for weekends', 'homey'); ?>">
                            </div>
                        </div>
                    <?php } elseif( $homey_booking_type == 'per_day_date' || $homey_booking_type == 'per_day' ) { ?>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="weekends_price"><?php echo esc_attr(homey_option('ad_weekends_label')).homey_req('experience_weekends_price'); ?></label>
                                <input type="text" name="weekends_price" class="form-control" <?php homey_required('experience_weekends_price'); ?> id="weekends_price" placeholder="<?php echo esc_attr(homey_option('ad_weekends_plac')); ?>">
                            </div>
                        </div>

                    <?php } ?>

                <?php } ?>

                <?php if(1==2 && $hide_fields['experience_weekends_days'] != 1 && ( $homey_booking_type == 'per_day_date' || $homey_booking_type == 'per_day' || $homey_booking_type == 'per_hour' ) ) { ?>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="weekends_days"><?php echo esc_attr(homey_option('ad_weekend_days_label')).homey_req('experience_weekends_days'); ?></label>
                            <select name="weekends_days" class="selectpicker" <?php homey_required('experience_weekends_days'); ?> id="weekends_days" data-live-search="false">
                                <option value="sat_sun"><?php echo esc_attr($homey_local['sat_sun_label']); ?></option>
                                <option value="fri_sat"><?php echo esc_attr($homey_local['fri_sat_label']); ?></option>
                                <option value="fri_sat_sun"><?php echo esc_attr($homey_local['fri_sat_sun_label']); ?></option>
                            </select>
                        </div>
                    </div>
                <?php } ?>

            </div>

            <?php if(1==2 && $homey_booking_type == 'per_day_date' || (1==2 && $homey_booking_type == 'per_day' ) ) { ?>
                <?php if($hide_fields['experience_priceWeek'] != 1 || $hide_fields['experience_priceMonthly'] != 1) { ?>
                    <hr class="row-separator">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <h3 class="sub-title"><?php echo esc_attr(homey_option('ad_long_term_pricing')); ?></h3>
                        </div>

                        <?php if($hide_fields['experience_priceWeek'] != 1) { ?>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <?php $priceWeekLabel = $homey_booking_type == 'per_day_date' ? homey_option('ad_weekly7DayDates') : homey_option('ad_weekly7nights'); ?>
                                    <?php $priceWeekPlac = $homey_booking_type == 'per_day_date' ? homey_option('ad_weekly7DayDates_plac') : homey_option('ad_weekly7nights_plac'); ?>
                                    <label for="priceWeek"><?php echo $priceWeekLabel.homey_req('experience_priceWeek'); ?></label>
                                    <input type="text" name="priceWeek" class="form-control" <?php homey_required('experience_priceWeek'); ?> id="priceWeek" placeholder="<?php echo esc_attr($priceWeekPlac); ?>">
                                </div>
                            </div>
                        <?php } ?>

                        <?php if($hide_fields['experience_priceMonthly'] != 1) { ?>
                            <?php $priceMonthlyLabel = $homey_booking_type == 'per_day_date' ? homey_option('ad_monthly30DayDates') : homey_option('ad_monthly30nights'); ?>
                            <?php $priceMonthlyPlac = $homey_booking_type == 'per_day_date' ? homey_option('ad_monthly30DayDates_plac') : homey_option('ad_monthly30nights_plac'); ?>

                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="priceMonthly"><?php echo homey_option('ad_monthly30nights').homey_req('experience_priceMonthly'); ?></label>
                                    <input type="text" name="priceMonthly" class="form-control" <?php homey_required('experience_priceMonthly'); ?> id="priceMonthly" placeholder="<?php echo esc_attr(homey_option('ad_monthly30nights_plac')); ?>">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <?php
            if(1==2 &&  $hide_fields['experience_extra_prices'] != 1) {
                get_template_part('template-parts/dashboard/submit-listing/extra');
            }
            ?>
            <?php if(1==2){ ?>
                <hr class="row-separator">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <h3 class="sub-title"><?php echo esc_attr(homey_option('ad_add_costs_label')); ?></h3>
                    </div>
                    <?php if(1==2 && $hide_fields['experience_allow_additional_guests'] != 1) { ?>
                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group">
                                <label for=""><?php echo esc_attr(homey_option('ad_allow_additional_guests')); ?></label>
                                <label class="control control--radio radio-tab">
                                    <input type="radio" name="allow_additional_guests" value="yes">
                                    <span class="control-text"><?php echo esc_attr(homey_option('ad_text_yes')); ?></span>
                                    <span class="control__indicator"></span>
                                    <span class="radio-tab-inner"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group">
                                <label for="">&nbsp</label>
                                <label class="control control--radio radio-tab">
                                    <input type="radio" name="allow_additional_guests" value="no" checked="checked">
                                    <span class="control-text"><?php echo esc_attr(homey_option('ad_text_no')); ?></span>
                                    <span class="control__indicator"></span>
                                    <span class="radio-tab-inner"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group">
                                <label for="additional_guests_price"><?php echo esc_attr(homey_option('ad_addinal_guests_label')); ?></label>
                                <input type="text" name="additional_guests_price" class="form-control" id="additional_guests_price" placeholder="<?php echo esc_attr(homey_option('ad_addinal_guests_plac')); ?>">
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group">
                                <label for="num_additional_guests"><?php echo esc_html__('No of Guests', 'homey'); ?></label>
                                <input type="text" name="num_additional_guests" class="form-control" id="num_additional_guests" placeholder="<?php echo esc_html__('Number of additional guests allowed', 'homey'); ?>">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php if(1==2 && $hide_fields['experience_cleaning_fee'] != 1) { ?>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <label><?php echo esc_attr(homey_option('ad_cleaning_fee')); ?></label>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input type="text" name="cleaning_fee" class="form-control" placeholder="<?php echo esc_attr(homey_option('ad_cleaning_fee_plac')); ?>">
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            <label class="control control--radio radio-tab">
                                <input type="radio" name="cleaning_fee_type" value="daily">
                                <span class="control-text"><?php echo esc_attr($fees_label); ?></span>
                                <span class="control__indicator"></span>
                                <span class="radio-tab-inner"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            <label class="control control--radio radio-tab">
                                <input type="radio" name="cleaning_fee_type" value="per_stay" checked="checked">
                                <span class="control-text"><?php echo esc_attr(homey_option('ad_perstay_text')); ?></span>
                                <span class="control__indicator"></span>
                                <span class="radio-tab-inner"></span>
                            </label>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if(1==2 && $hide_fields['experience_city_fee'] != 1) { ?>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <label><?php echo esc_attr(homey_option('ad_city_fee')); ?></label>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input type="text" name="city_fee" class="form-control" placeholder="<?php echo esc_attr(homey_option('ad_city_fee_plac')); ?>">
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            <label class="control control--radio radio-tab">
                                <input type="radio" name="city_fee_type" value="daily">
                                <span class="control-text"><?php echo esc_attr($fees_label); ?></span>
                                <span class="control__indicator"></span>
                                <span class="radio-tab-inner"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            <label class="control control--radio radio-tab">
                                <input type="radio" name="city_fee_type" value="per_stay" checked="checked">
                                <span class="control-text"><?php echo esc_attr(homey_option('ad_perstay_text')); ?></span>
                                <span class="control__indicator"></span>
                                <span class="radio-tab-inner"></span>
                            </label>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if(1==2 && $hide_fields['security_deposit'] != 1 || ( 1==2 && $hide_fields['experience_tax_rate'] != 1)) { ?>
                <div class="row">

                    <?php if($hide_fields['security_deposit'] != 1) { ?>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="security_deposit"><?php echo esc_attr(homey_option('ad_security_deposit_label')); ?></label>
                                <input type="text" name="security_deposit" class="form-control" id="security_deposit" placeholder="<?php echo esc_attr(homey_option('ad_security_deposit_plac')); ?>">
                            </div>
                        </div>
                    <?php } ?>

                    <?php if($hide_fields['experience_tax_rate'] != 1 && homey_option('tax_type') == 'single_tax') { ?>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="tax_rate"><?php echo esc_attr(homey_option('ad_tax_rate_label')); ?></label>
                                <input type="text" name="tax_rate" class="form-control" id="tax_rate" placeholder="<?php echo esc_attr(homey_option('ad_tax_rate_plac')); ?>">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php //get_template_part('template-parts/dashboard/edit-experience/price-terms'); ?>

</div>
