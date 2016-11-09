<?php
namespace Intern\UI\Shortcode;

add_shortcode('intern_resume', ['Intern\UI\Shortcode\Resume', 'construct']);

class Resume
{
    public function construct()
    {
        wp_enqueue_style('css-sweetalert');
        wp_enqueue_script('js-sweetalert');
        wp_enqueue_style('pnotify');
        wp_enqueue_script('pnotify');
        wp_enqueue_style('select2');
        wp_enqueue_script('select2');

        ob_start();
        include ('template/resume.php');
        ?>
        <script>
            (function($) {
                $(document).ready(function() {
                    $('select').select2();
                });
            })(jQuery);

        </script>
<?php
        return ob_get_clean();
    }
}
