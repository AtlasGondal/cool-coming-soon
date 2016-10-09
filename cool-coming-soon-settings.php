<?php
    if( !defined( 'ABSPATH') )
        exit();

    echo wp_nonce_field('_');
?>
<style>
    li{list-style:circle;margin-left:30px;}#background,code{float:right}input.input-field{width:100%}#background{width:85%}#bg-options{width:10%;float:left}.form-table th{width:20%}
</style>

    <div class="wrap">

        <h1 align="center">Cool Coming Soon</h1>
        <?php



        ?>

        <?php

            $cool_coming_soon_data              = get_option('cool_coming_soon_data');
            $cool_coming_soon_display           = get_option('cool_coming_soon_display');
            $ccs_errors                         = array();
            $active_tab                         = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'data';

            if( isset($_POST['submit']) && ($active_tab == 'data') ){

                check_admin_referer('ccss_save_data_changes');

                $maintenance_mode               = ( !empty( $_POST['maintenance_mode']) ? sanitize_text_field( stripslashes($_POST['maintenance_mode']) ) : '' );
                $bg_options                     = ( !empty( $_POST['bg_options']) ? sanitize_file_name($_POST['bg_options']) : '' );
                $background                     = ( !empty($_POST['background'])) ? (filter_var(($_POST['background']), FILTER_VALIDATE_URL) ? $_POST['background'] : $ccs_errors[] = 'Invalid background URL') : '';
                $logo                           = ( filter_var(($_POST['logo']), FILTER_VALIDATE_URL) ? $_POST['logo'] : $ccs_errors[] = 'Invalid logo URL');
                $page_title                     = ( !empty( $_POST['page_title']) ? sanitize_text_field( stripslashes($_POST['page_title']) ) : '' );
                $heading                        = ( !empty( $_POST['heading']) ? sanitize_text_field( stripslashes($_POST['heading']) ) : '' );
                $description                    = ( !empty( $_POST['description']) ? wp_kses_post($_POST['description']) : '' );
                $date                           = ((preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $_POST['date'])) ? $_POST['date'] : $ccs_errors[] = 'Invalid Date');


                if(!isset($ccs_data)){
                    $ccs_data = new stdClass();
                }

                $ccs_data->name                 = 'Cool Coming Soon';
                $ccs_data->maintenance_mode     = $maintenance_mode;
                $ccs_data->bg_options           = $bg_options;
                $ccs_data->background_url       = $background;
                $ccs_data->logo_url             = $logo;
                $ccs_data->page_title           = $page_title;
                $ccs_data->heading              = $heading;
                $ccs_data->description          = $description;
                $ccs_data->date                 = $date;

                if(empty($ccs_errors)){
                    update_option('cool_coming_soon_data', $ccs_data);
                    echo '<div class="notice notice-success is-dismissible"><p><strong>Changes saved!</strong></p></div>';

                }else{
                    echo '<div class="notice notice-error"><p><strong>Changes are not saved, Validation Error Occur!</strong></p></div>';

                }
                $cool_coming_soon_data          = get_option('cool_coming_soon_data');
            }elseif( isset($_POST['submit']) && ($_GET['tab'] == 'display_options') ){
                check_admin_referer('ccss_save_display_changes');

                $display_background             = ( !empty( $_POST['display-background']) ? sanitize_text_field( stripslashes( $_POST['display-background'] ) ) : '' );
                $display_logo                   = ( !empty( $_POST['display-logo']) ? sanitize_text_field( stripslashes( $_POST['display-logo'] ) ) : '' );
                $display_heading                = ( !empty( $_POST['display-heading']) ? sanitize_text_field( stripslashes( $_POST['display-heading'] ) ) : '' );
                $display_description            = ( !empty( $_POST['display-description']) ? sanitize_text_field( stripslashes( $_POST['display-description'] ) ) : '' );
                $display_date                   = ( !empty( $_POST['display-date']) ? sanitize_text_field($_POST['display-date']) : '' );

                if(!isset($ccs_data)){
                    $ccs_data = new stdClass();
                }

                $ccs_data->display_background   = $display_background;
                $ccs_data->display_logo         = $display_logo;
                $ccs_data->display_title        = $display_heading;
                $ccs_data->display_description  = $display_description;
                $ccs_data->display_date         = $display_date;

                update_option('cool_coming_soon_display', $ccs_data);
                echo '<div class="notice notice-success is-dismissible"><p><strong>Changes saved!</strong></p></div>';
                $cool_coming_soon_display       = get_option('cool_coming_soon_display');
            }



            $date_arr = explode("-", $cool_coming_soon_data->date);

        ?>

            <h2 class="nav-tab-wrapper">
                <a href="?page=cool-coming-soon-settings&tab=data" class="nav-tab <?php echo $active_tab == 'data' ? 'nav-tab-active' : ''; ?>">Update Data</a>
                <a href="?page=cool-coming-soon-settings&tab=display_options" class="nav-tab  <?php echo $active_tab == 'display_options' ? 'nav-tab-active' : ''; ?>">Display Options</a>

            </h2>
        <form id="infoForm" method="post">
                <div id="WtiLikePostOptions" class="postbox">

                    <div class="inside">

                        <table class="form-table">
                            <tbody>


                                <?php

                                    if( $active_tab == 'display_options' ) {
                                ?>
                                        <tr>
                                            <th scope="row"><label for="display-background">Display Background</label></th>
                                            <td>
                                                <input type="radio" name="display-background" value="Yes" <?php echo ($cool_coming_soon_display->display_background == 'Yes' ? 'checked' : '') ?>>Yes&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="display-background" value="No" <?php echo ($cool_coming_soon_display->display_background == 'No' ? 'checked' : '') ?>>No
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label for="display-logo">Display Logo</label></th>
                                            <td>
                                                <input type="radio" name="display-logo" value="Yes" <?php echo ($cool_coming_soon_display->display_logo == 'Yes' ? 'checked' : '') ?>>Yes&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="display-logo" value="No" <?php echo ($cool_coming_soon_display->display_logo == 'No' ? 'checked' : '') ?>>No
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label for="display-heading">Display Heading</label></th>
                                            <td>
                                                <input type="radio" name="display-heading" value="Yes" <?php echo ($cool_coming_soon_display->display_title == 'Yes' ? 'checked' : '') ?>>Yes&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="display-heading" value="No" <?php echo ($cool_coming_soon_display->display_title == 'No' ? 'checked' : '') ?>>No
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label for="display-description">Display Description</label></th>
                                            <td>
                                                <input type="radio" name="display-description" value="Yes" <?php echo ($cool_coming_soon_display->display_description == 'Yes' ? 'checked' : '') ?>>Yes&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="display-description" value="No"  <?php echo ($cool_coming_soon_display->display_description == 'No' ? 'checked' : '') ?>>No
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label for="display-date">Display Launch Date</label></th>
                                            <td>
                                                <input type="radio" name="display-date" value="Yes" <?php echo ($cool_coming_soon_display->display_date == 'Yes' ? 'checked' : '') ?>>Yes&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="display-date" value="No"  <?php echo ($cool_coming_soon_display->display_date == 'No' ? 'checked' : '') ?>>No
                                                <?php wp_nonce_field('ccss_save_display_changes'); ?>
                                            </td>
                                        </tr>

                                <?php
                                    } else {
                                ?>
                                        <tr>
                                            <th scope="row"><label for="maintenance_mode">Maintenance Mode</label></th>
                                            <td>
                                                <input type="radio" required name="maintenance_mode" value="1" <?php echo ($cool_coming_soon_data->maintenance_mode == 1 ? 'checked' : '') ?>>On&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="maintenance_mode" value="0" <?php echo ($cool_coming_soon_data->maintenance_mode == 0 ? 'checked' : '') ?>>Off
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label for="logo">Background Image URL<code>1920 x 1080</code></label></th>
                                            <td align="center">
                                                <select name="bg_options" id="bg-options">
                                                    <option value="bg" <?php echo ($cool_coming_soon_data->bg_options == 'bg' ? 'selected' : '') ?>>Sunrise</option>
                                                    <option value="bg2" <?php echo ($cool_coming_soon_data->bg_options == 'bg2' ? 'selected' : '') ?>>Mountain</option>
                                                    <option value="bg3" <?php echo ($cool_coming_soon_data->bg_options == 'bg3' ? 'selected' : '') ?>>City</option>
                                                    <option value="bg4" <?php echo ($cool_coming_soon_data->bg_options == 'bg4' ? 'selected' : '') ?>>Stars & Moon</option>
                                                    <option value="bg5" <?php echo ($cool_coming_soon_data->bg_options == 'bg5' ? 'selected' : '') ?>>Sky</option>
                                                    <option value="bg6" <?php echo ($cool_coming_soon_data->bg_options == 'bg6' ? 'selected' : '') ?>>eCommerce</option>
                                                </select>
                                                <strong>OR</strong>
                                                <input type="url" name="background" id="background" title="Custom Background Image has Higher Priority, if you wanted to use pre-bundled background then leave this field empty!" value="<?php echo esc_url($cool_coming_soon_data->background_url)?>" placeholder="Paste Your Background URL" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label for="logo">Logo URL<code>250 x 250</code></label></th>
                                            <td>
                                                <input type="url" name="logo" required class="input-field" id="logo" value="<?php echo esc_url($cool_coming_soon_data->logo_url)?>" placeholder="Paste Your Logo URL" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label for="page_title">Page Title<code>Less than 55 Characters</code></label></th>
                                            <td>
                                                <input type="text" name="page_title" required class="input-field" id="page_title" title="This will appear in browser tab." value="<?php echo esc_attr($cool_coming_soon_data->page_title)?>" placeholder="Heading or Coming soon title" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label for="heading">Heading<code>Less than or equal to 3 words</code></label></th>
                                            <td>
                                                <input type="text" name="heading" required class="input-field" id="heading" value="<?php echo esc_attr($cool_coming_soon_data->heading)?>" placeholder="Heading or Coming soon title" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label for="logo">Description</label></th>
                                            <td>
                                                <?php
                                                        $content = $cool_coming_soon_data->description;
                                                        $settings = array(
                                                            'wpautop'       => true,
                                                            'media_buttons' => false,
                                                            'textarea_name' => 'description',
                                                            'textarea_rows' => 10,
                                                            'teeny'         => true
                                                        );

                                                        wp_editor( $content, 'description', $settings );
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label for="date">Launch Date</label></th>
                                            <td>
                                                <input type="date" name="date" class="input-field" id="date" min="<?php echo date('Y')."-".date('m')."-".date('d');?>" value="<?php echo $date_arr[0]."-".$date_arr[1]."-".$date_arr[2]?>" placeholder="Heading or Coming soon title" />
                                                <?php wp_nonce_field('ccss_save_data_changes'); ?>
                                            </td>
                                        </tr>

                                <?php

                                    }

                                ?>



                            </tbody>
                        </table>

                    </div>

                </div>
            <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
        </form>
        <h4 align="right">Developed by: <a href="http://AtlasGondal.com/?utm_source=self&utm_medium=wp&utm_campaign=plugin&utm_term=cool-coming-soon" target="_blank">Atlas Gondal</a></h4>

    </div>



