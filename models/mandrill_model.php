<?php

class Mandrill_model extends MY_Model
{


    function __construct()
    {
        parent::__construct();
    }


    /**
     * Store a raw unprocessed log of data received form Mandrill
     *
     * @param $mandrill_posted_json
     */
    public function log_received_data($mandrill_posted_json)
    {
        if ($mandrill_posted_json != '') {
            $this->load->helper('file');

            if (!write_file('./application/logs/mandrill_' . date("Y-m-d-H:i:s") . '.json', $mandrill_posted_json)) {
                log_message('error', 'Unable to log the incoming Mandrill data, folder not writeable ? ');
            } else {
                log_message('info', 'Some Mandrill data received successfully');
            }
        }
    }

    /**
     * Save the details of the incoming email to a table
     *
     * @param $mandrill_posted_array
     */
    public function save_incoming_email($mandrill_posted_array)
    {
        if (isset($mandrill_posted_array['event']) && $mandrill_posted_array['event'] == 'inbound') {

            $message_data_array = $mandrill_posted_array['msg'];

            $this->db->insert('email_log_table', $message_data_array);
        }
    }

    /**
     * Send an automated email response to the user
     *
     * @param $mandrill_posted_array
     */
    public function send_auto_response($mandrill_posted_array)
    {
        $this->load->library('email');

        $email_subject = '';
        $customer_email = '';
        $band_name = '';

        /*
         * parse some needed information from the array of incoming data
         */
        if (isset($mandrill_posted_array['event']) && $mandrill_posted_array['event'] == 'inbound') {
            $message_data_array = $mandrill_posted_array['msg'];
            $email_subject = 'Re:' . $message_data_array['subject'];
            $customer_email = $message_data_array['from_email'];
        }

        $this->email->from('example@app.domain.com', 'My web application');

        $this->email->to($customer_email);

        $this->email->subject($email_subject);

        $email_content = $this->load->view('email_templates/auto_response', null, true);

        $this->email->message($email_content);

        $this->email->send();

    }

}
/* End of file mandrill_model.php */
/* Location: ./application/models/mandrill_model.php */
