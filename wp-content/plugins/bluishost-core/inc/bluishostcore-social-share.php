<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit( 'Direct script access denied.' );
}
/**
 * @Packge     : Bluishost
 * @Version    : 1.0
 * @Author     : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
  
// share button code
function bluishost_social_sharing_buttons( $ulClass = 'share-icons list-inline text-sm-right' ,$tagLine = '' ) {
    
	
    // Get page URL 
    $URL = get_permalink();
    $Sitetitle = get_bloginfo('name');
    // Get page title
    $Title = str_replace( ' ', '%20', get_the_title());
    
    // Construct sharing URL without using any script
    $twitterURL = 'https://twitter.com/intent/tweet?text='.esc_html( $Title ).'&amp;url='.esc_url( $URL ).'&amp;via='.esc_html( $Sitetitle );
    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.esc_url( $URL );
    $googleURL = 'https://plus.google.com/share?url='.esc_url( $URL );
    $linkedin = 'https://www.linkedin.com/shareArticle?mini=true&url='.esc_url( $URL ).'&title='.esc_html( $Title );
     
    // Add sharing button at the end of page/page content
	$content = '';
    $content  .= '<ul class="'.esc_attr( $ulClass ).'">';
    $content .= $tagLine;
    $content .= '<li><a href="'. esc_url( $twitterURL ) .'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
    $content .= '<li><a href="'.esc_url( $facebookURL ).'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
    $content .= '<li><a href="'.esc_url( $googleURL ).'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
    $content .= '<li><a href="'.esc_url( $linkedin ).'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
    $content .= '</ul>';
    
    echo $content;

};

// Author profile social icon
// Edit Profile 
add_action( 'show_user_profile', 'bluishost_show_profile_fields' );
add_action( 'edit_user_profile', 'bluishost_show_profile_fields' );
function bluishost_show_profile_fields( $user ) {
        
    $fburl = get_the_author_meta( 'fb_url', $user->ID );
    $twurl = get_the_author_meta( 'tw_url', $user->ID );
    $gpurl = get_the_author_meta( 'gp_url', $user->ID );
    $ldurl = get_the_author_meta( 'ld_url', $user->ID );
    $fdurl = get_the_author_meta( 'fd_url', $user->ID );
    $inurl = get_the_author_meta( 'in_url', $user->ID );
        
    ?>
    <h3><?php esc_html_e( 'Personal Information', 'kripdom' ); ?></h3>

    <table class="form-table">
        <tr>
            <th><label for="fb_url"><?php esc_html_e( 'Facebook Url', 'kripdom' ); ?></label></th>
            <td>
                <input type="text"
                   id="fb_url"
                   name="fb_url"
                   value="<?php echo esc_url( $fburl ); ?>"
                   class="regular-text"
                />
            </td>
        </tr>
        <tr>
            <th><label for="tw_url"><?php esc_html_e( 'Twitter Url', 'kripdom' ); ?></label></th>
            <td>
                <input type="text"
                   id="tw_url"
                   name="tw_url"
                   value="<?php echo esc_url( $twurl ); ?>"
                   class="regular-text"
                />
            </td>
        </tr>
        <tr>
            <th><label for="gp_url"><?php esc_html_e( 'Google Plus Url', 'kripdom' ); ?></label></th>
            <td>
                <input type="text"
                   id="gp_url"
                   name="gp_url"
                   value="<?php echo esc_url( $gpurl ); ?>"
                   class="regular-text"
                />
            </td>
        </tr>
        <tr>
            <th><label for="ld_url"><?php esc_html_e( 'Linkedin Url', 'kripdom' ); ?></label></th>
            <td>
                <input type="text"
                   id="ld_url"
                   name="ld_url"
                   value="<?php echo esc_url( $ldurl ); ?>"
                   class="regular-text"
                />
            </td>
        </tr>
        <tr>
            <th><label for="fd_url"><?php esc_html_e( 'feed Url', 'kripdom' ); ?></label></th>
            <td>
                <input type="text"
                   id="fd_url"
                   name="fd_url"
                   value="<?php echo esc_url( $fdurl ); ?>"
                   class="regular-text"
                />
            </td>
        </tr>
        <tr>
            <th><label for="in_url"><?php esc_html_e( 'Instagram Url', 'kripdom' ); ?></label></th>
            <td>
                <input type="text"
                   id="in_url"
                   name="in_url"
                   value="<?php echo esc_url( $inurl ); ?>"
                   class="regular-text"
                />
            </td>
        </tr>
    </table>
    <?php
}

add_action( 'personal_options_update', 'bluishost_update_profile_fields' );
add_action( 'edit_user_profile_update', 'bluishost_update_profile_fields' );
function bluishost_update_profile_fields( $user_id ) {
    if ( ! current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
   
    if ( ! empty( $_POST['fb_url'] ) ) {
        update_user_meta( $user_id, 'fb_url', esc_url_raw( $_POST['fb_url'] ) );
    }

    if ( ! empty( $_POST['tw_url'] ) ) {
        update_user_meta( $user_id, 'tw_url', esc_url_raw( $_POST['tw_url'] ) );
    }

    if ( ! empty( $_POST['gp_url'] ) ) {
        update_user_meta( $user_id, 'gp_url',  esc_url_raw( $_POST['gp_url'] ) );
    }
    if ( ! empty( $_POST['ld_url'] ) ) {
        update_user_meta( $user_id, 'ld_url',  esc_url_raw( $_POST['ld_url'] ) );
    }
    if ( ! empty( $_POST['fd_url'] ) ) {
        update_user_meta( $user_id, 'fd_url',  esc_url_raw( $_POST['fd_url'] ) );
    }
    if ( ! empty( $_POST['in_url'] ) ) {
        update_user_meta( $user_id, 'in_url',  esc_url_raw( $_POST['in_url'] ) );
    }
}

function bluishost_biography_social_link() {
    $fb_url = get_the_author_meta( 'fb_url' );
    $tw_url = get_the_author_meta( 'tw_url' );
    $gp_url = get_the_author_meta( 'gp_url' );
    $ld_url = get_the_author_meta( 'ld_url' );
    $fd_url = get_the_author_meta( 'fd_url' );
    $in_url = get_the_author_meta( 'in_url' );
    
    if( $fb_url || $tw_url || $gp_url || $ld_url || $fd_url || $in_url ) {
        echo '<ul class="share-icons list-inline mb-0">';
            if ( ! empty( $fb_url ) ) {
                echo '<li><a href="'.esc_url( $fb_url ).'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
            }
            if ( ! empty( $tw_url ) ) {
                echo '<li><a href="'.esc_url( $tw_url ).'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
            }
            if ( ! empty( $gp_url ) ) {
                echo '<li><a href="'.esc_url( $gp_url ).'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
            }
            if ( ! empty( $ld_url ) ) {
                echo '<li><a href="'.esc_url( $ld_url ).'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
            }
            if ( ! empty( $fd_url ) ) {
                echo '<li><a href="'.esc_url( $fd_url ).'" target="_blank"><i class="fa fa-feed"></i></a></li>';
            }
            if ( ! empty( $in_url ) ) {
                echo '<li><a href="'.esc_url_raw( $in_url ).'" target="_blank"><i class="fa fa-instagram"></i></a></li>';
            }
        echo '</ul>';
    }
}