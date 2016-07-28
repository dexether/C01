<?php
class MY_Exceptions extends CI_Exceptions
{

    /**
     * 404 Error Handler
     *
     * @uses    CI_Exceptions::show_error()
     *
     * @param   string  $page       Page URI
     * @param   bool    $log_error  Whether to log the error
     * @return  void
     */
    public function show_404($page = '', $log_error = true)
    {
        if (is_cli()) {
            $heading = 'Not Found';
            $message = 'The controller/method pair you requested was not found.';
        } else {
            $heading = '404 Page Not Found';
            $message = 'The page you requested was not found.';
        }

        // By default we log this, but allow a dev to skip it
        if ($log_error) {
            log_message('error', $heading . ': ' . $page);
        }

        $CI = &get_instance();
        // $CI->load->view('mall/404', $CI->view_data); //Note I am using layout library. You'll probably use $CI->load->view()
        redirect('404','refresh');
        echo $CI->output->get_output();
        exit(4); // EXIT_UNKNOWN_FILE
    }
}