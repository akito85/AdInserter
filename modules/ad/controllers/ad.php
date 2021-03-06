<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * BackendPro
 *
 * A website backend system for developers for PHP 4.3.2 or newer
 *
 * @package         BackendPro
 * @author          Adam Price
 * @copyright       Copyright (c) 2008
 * @license         http://www.gnu.org/licenses/lgpl.html
 * @link            http://www.kaydoo.co.uk/projects/backendpro
 * @filesource
 */

// ---------------------------------------------------------------------------

/**
 * Members
 *
 * Allow the user to manage website users
 *
 * @package         BackendPro
 * @subpackage      Controllers
 */
class Ad extends Public_Controller
{
	function Ad()
	{
		parent::Public_Controller();

		$this->load->helper('form');

        $this->load->model('ad_model');
		// Load userlib language
		$this->lang->load('userlib');

		// Set breadcrumb
		$this->bep_site->set_crumb('Ad Campaign','ad');

		// Check for access permission
		//check('Members');

		// Load the validation library
		$this->load->library('validation');

		log_message('debug','BackendPro : Members class loaded');
	}

	/**
	 * View Members
	 *
	 * @access public
	 */
	function index()
	{
		//is_user();
		
		// Get Member Infomation
		$data['members'] = $this->ad_model->getCampaign(array('user_id'=>$this->session->userdata('id')));

		// Display Page
		$data['header'] = 'Ad Campaign';
		$data['page'] = $this->config->item('backendpro_template_public') . "view";
		$data['module'] = 'ad';
		$this->load->view($this->_container,$data);
	}

	/**
	 * Set Profile Defaults
	 *
	 * Specify what values should be shown in the profile fields when creating
	 * a new user by default
	 *
	 * @access private
	 */
	function _set_profile_defaults()
	{
		//$this->validation->set_default_value('field1','value');
		//$this->validation->set_default_value('field2','value');
		$this->validation->set_default_value('gender','male');
		$this->validation->set_default_value('fullname','John Smith');
		$this->validation->set_default_value('company','Some Company');
		$this->validation->set_default_value('dob','1960-01-01');
		$this->validation->set_default_value('dob_y','1960');
		$this->validation->set_default_value('dob_m','01');
		$this->validation->set_default_value('dob_d','01');
		$this->validation->set_default_value('street','MH Thamrin');
	  $this->validation->set_default_value('city','Jakarta');                                         
    $this->validation->set_default_value('zip','90210');     
		$this->validation->set_default_value('country','Indonesia');
		$this->validation->set_default_value('domain',base_url());
    }


	/**                                       
	 * Get User Details                        
	 *
	 * Load user detail values from the submited form
	 *
	 * @access private
	 * @return array
	 */
	function _get_campaign_details()
	{
		//print_r($_POST);
		
		//$data['id'] = $this->input->post('id');
		//$data['company_id'] = $this->input->post('company_id');
		$data['user_id'] = $this->session->userdata('id');
		$data['cpn_name'] = $this->input->post('cpn_name');
		$data['cpn_start'] = $this->input->post('cpn_start');
        $data['cpn_end'] = $this->input->post('cpn_end');
		$data['cpn_time_start'] = $this->input->post('cpn_time_start');
        $data['cpn_time_end'] = $this->input->post('cpn_time_end');
        $data['allday'] = $this->input->post('allday');
        $data['cpn_landing_uri'] = $this->input->post('cpn_landing_uri');
        $data['campaign_id'] = $this->input->post('campaign_id');
        $data['color'] = $this->input->post('color');
        //$data['datecreated'] = $this->input->post('datecreated');
        $data['active'] = $this->input->post('active');
        
		return $data;
	}

	/**                                       
	 * Get User Details                        
	 *
	 * Load user detail values from the submited form
	 *
	 * @access private
	 * @return array
	 */
	function _get_schedule_details()
	{
		//print_r($_POST);
		
		//print_r(json_decode($_POST['eventobjects']));
		
		//$data['id'] = $this->input->post('id');
		//$data['company_id'] = $this->input->post('company_id');
        $data['campaign_id'] = $this->input->post('campaign_id');
		$data['user_id'] = $this->session->userdata('id');
		$data['cpn_name'] = $this->input->post('cpn_name');
		$data['cpn_start'] = $this->input->post('cpn_start');
        $data['cpn_end'] = $this->input->post('cpn_end');
		$data['cpn_time_start'] = $this->input->post('cpn_time_start');
        $data['cpn_time_end'] = $this->input->post('cpn_time_end');
        $data['allday'] = $this->input->post('allday');
        $data['cpn_landing_uri'] = $this->input->post('cpn_landing_uri');
        $data['color'] = $this->input->post('color');
        //$data['datecreated'] = $this->input->post('datecreated');
        $data['active'] = $this->input->post('active');
        
		return $data;
	}

	function _get_audience_details()
	{
		//print_r($_POST);
		
		//$data['id'] = $this->input->post('id');
		//$data['company_id'] = $this->input->post('company_id');
		$data['browser'] = $this->input->post('browser');
		$data['url_exclude'] = $this->input->post('url_exclude');
		$data['url_include'] = $this->input->post('url_include');
		$data['browser_exclude'] = $this->input->post('browser_exclude');
		$data['browser_include'] = $this->input->post('browser_include');
		$data['domain'] = $this->input->post('domain');
		$data['order_impression'] = $this->input->post('order_impression');
        $data['order_click'] = $this->input->post('order_click');
        
		return $data;
	}

	/**
	 * Display Member Form
	 *
	 * @access public
	 * @param integer $id Member ID
	 */
	function form($id = NULL)
	{
		// VALIDATION FIELDS
		$fields['id'] = "ID";
        $fields['company_id'] = 'Company ID';
        $fields['user_id'] = 'User ID';
        $fields['cpn_name'] = 'Campaign Title';
        $fields['cpn_start'] = 'Campaign Start';
        $fields['cpn_end'] = 'Campaign End';
        $fields['cpn_time_start'] = 'Time Start';
        $fields['cpn_time_end'] = 'Time End';
        $fields['allday'] = 'All Day';
        $fields['cpn_landing_uri'] = 'Campaign Landing URL';
        $fields['campaign_id'] = 'Campaign ID';
        $fields['color'] = 'Calendar Color';
        $fields['datecreated'] = 'Date Created';
        $fields['active'] = 'Status';

		$this->validation->set_fields($fields);

        $rules['company_id'] = 'trim';
        $rules['user_id'] = 'trim';
        $rules['cpn_name'] = 'trim';
        $rules['cpn_start'] = 'trim';
        $rules['cpn_end'] = 'trim';
        $rules['cpn_time_start'] = 'trim';
        $rules['cpn_time_end'] = 'trim';
        $rules['allday'] = 'trim';
        $rules['cpn_landing_uri'] = 'trim';
        $rules['campaign_id'] = 'trim';
        $rules['color'] = 'trim';
        //$rules['datecreated'] = 'trim';
        $rules['active'] = 'trim';
        
        
        $data['sizes'] = $this->ad_model->fetch("BannerSize");
        

		// Setup validation rules

		// Setup form default values
		if( ! is_null($id) AND ! $this->input->post('submit'))
		{
			// Modify form, first load
			$campaign = $this->ad_model->getCampaign(array('id'=>$id));
			$campaign = $campaign->row_array();
			
			$this->validation->set_default_value($campaign);
		}
		elseif( is_null($id) AND ! $this->input->post('submit'))
		{
			// Create form, first load
			$this->validation->set_default_value('active','1');
		}
		elseif( $this->input->post('submit'))
		{
			// Form submited, check rules
			$this->validation->set_rules($rules);
		}

		// RUN
		if ($this->validation->run() === FALSE)
		{

			// Display form
			$this->validation->output_errors();
			$data['header'] = ( is_null($id)?$this->bep_assets->icon('titles/64/add-campaign'):$this->bep_assets->icon('titles/64/update-campaign'));
			$this->bep_site->set_crumb($data['header'],'ad/form/'.$id);
			$data['page'] = $this->config->item('backendpro_template_public') . "form_campaign";
			$data['module'] = 'ad';
			$this->load->view($this->_container,$data);
		}
		else
		{
			// Save form
			if( is_null($id))
			{
				// CREATE
				// Fetch form values
				$campaign = $this->_get_campaign_details();
				$campaign['datecreated'] = date('Y-m-d H:i:s');

				$this->db->trans_begin();
				$this->ad_model->insert('Campaign',$campaign);
				$campaign_id = $this->db->insert_id();

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success',sprintf('Campaign: %s saved, Please Set Initial Schedule',$campaign['cpn_name']));

				    $this->_upload_files($campaign_id);

    				redirect('ad/schedule/'.$campaign_id);
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to save %s',$campaign['cpn_name']));
    				redirect('ad');
				}
			}
			else
			{
				// SAVE
				$campaign = $this->_get_campaign_details();
				$campaign['modified'] = date('Y-m-d H:i:s');

				$this->db->trans_begin();
				$this->ad_model->update('Campaign',$campaign,array('id'=>$id));

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success',sprintf('Campaign: %s updated',$campaign['cpn_name']));
				
				    $this->_upload_files($id);
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to update %s',$campaign['cpn_name']));
				}
				redirect('ad');
			}
		}
	}
	
	
	function schedsave(){
	    $data = json_decode($this->input->post('obj'));
		//print_r($data);
		$sch['campaign_id'] = $data->campaign_id;
		$sch['user_id'] = $data->user_id;
		$sch['title'] = $data->title;
		$sch['color']	 = $data->color;
		$sch['cpn_id'] = $data->cpn_id;
		$sch['cpn_start'] = $data->cpn_start;
		$sch['cpn_end']	 = $data->cpn_end;
		$sch['cpn_time_start'] = $data->cpn_time_start;
		$sch['cpn_time_end'] = $data->cpn_time_end;
		$sch['allday'] = (is_null($data->allday) || $data->allday == false)?0:1;
	
	    $this->ad_model->insert('CampaignSchedules',$sch);
	}

	/**
	 * Display Member Form
	 *
	 * @access public
	 * @param integer $id Member ID
	 */
	function audience($id = NULL)
	{
		// VALIDATION FIELDS
		$fields['id'] = "ID";
        $fields['domain'] = 'Domain';
        $fields['browser'] = 'Browser';
        $fields['order_impression'] = 'Impressions Order';
        $fields['order_click'] = 'Clicks Order';

		$this->validation->set_fields($fields);

        $rules['id'] = 'trim';
        $rules['domain'] = 'trim';
        $rules['browser'] = 'trim';
        $rules['order_impression'] = 'trim';
        $rules['order_click'] = 'trim';

        $data['top_domains'] = $this->ad_model->fetch("TopDomain");

		// Setup validation rules

		// Setup form default values
		if( ! is_null($id) AND ! $this->input->post('submit'))
		{
			// Modify form, first load
			$campaign = $this->ad_model->getCampaign(array('id'=>$id));
			$campaign = $campaign->row_array();
			
			$data['campaign'] = $campaign;
			//print_r($campaign);
			
			$this->validation->set_default_value($campaign);
			//$this->validation->set_default_value('domain',$campaign['domain']);
			//$this->validation->set_default_value('browser',$campaign['browser']);
		}
		elseif( is_null($id) AND ! $this->input->post('submit'))
		{
			// Create form, first load
			$this->validation->set_default_value('domain','all');
			$this->validation->set_default_value('browser','all');
		}
		elseif( $this->input->post('submit'))
		{
			// Form submited, check rules
			$this->validation->set_rules($rules);
		}

		// RUN
		if ($this->validation->run() === FALSE)
		{

			// Display form
			$this->validation->output_errors();
			$data['header'] = ( is_null($id)?'Set Audience':'Update Audience');
			$this->bep_site->set_crumb($data['header'],'ad/audience/'.$id);
			$data['page'] = $this->config->item('backendpro_template_public') . "form_audience";
			$data['module'] = 'ad';
			$this->load->view($this->_container,$data);
		}
		else
		{
			// Save form
			if( is_null($id))
			{
				// CREATE
				// Fetch form values
				$campaign = $this->_get_audience_details();

				$this->db->trans_begin();

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success','Campaign saved');
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error','Failed to save campaign');
				}
				redirect('ad');
			}
			else
			{
				// SAVE
				$campaign = $this->_get_audience_details();
				$campaign['modified'] = date('Y-m-d H:i:s');
				
				

				$this->db->trans_begin();
				$this->ad_model->update('Campaign',$campaign,array('id'=>$id));

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success','Campaign saved');
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to update %s',$campaign['cpn_name']));
				}
				redirect('ad');
			}
		}
	}


	/**
	 * Display Member Form
	 *
	 * @access public
	 * @param integer $id Member ID
	 */
	function schedule($id = NULL)
	{
		// VALIDATION FIELDS
		$fields['id'] = "ID";
        $fields['company_id'] = 'Company ID';
        $fields['user_id'] = 'User ID';
        $fields['cpn_name'] = 'Campaign Title';
        $fields['cpn_start'] = 'Campaign Start';
        $fields['cpn_end'] = 'Campaign End';
        $fields['cpn_landing_uri'] = 'Campaign Landing URL';
        $fields['campaign_id'] = 'Campaign ID';
        $fields['color'] = 'Calendar Color';
        $fields['datecreated'] = 'Date Created';
        $fields['active'] = 'Status';

		$this->validation->set_fields($fields);

        $rules['company_id'] = 'trim';
        $rules['user_id'] = 'trim';
        $rules['cpn_name'] = 'trim';
        $rules['cpn_start'] = 'trim';
        $rules['cpn_end'] = 'trim';
        $rules['cpn_landing_uri'] = 'trim';
        $rules['campaign_id'] = 'trim';
        $rules['color'] = 'trim';
        //$rules['datecreated'] = 'trim';
        $rules['active'] = 'trim';

		// Setup validation rules

		// Setup form default values
		if( ! is_null($id) AND ! $this->input->post('submit'))
		{
			// Modify form, first load
			$campaign = $this->ad_model->getCampaign(array('id'=>$id));
			$campaign = $campaign->row_array();
			
			$data['campaign'] = $campaign;
			
			$this->validation->set_default_value($campaign);
		}
		elseif( is_null($id) AND ! $this->input->post('submit'))
		{
			// Create form, first load
			$this->validation->set_default_value('active','1');
		}
		elseif( $this->input->post('submit'))
		{
			// Form submited, check rules
			$this->validation->set_rules($rules);
		}

		// RUN
		if ($this->validation->run() === FALSE)
		{

			// Display form
			$this->validation->output_errors();
			$data['header'] = ( is_null($id)?'Create New Schedule':'Set Schedule Dates');
			$this->bep_site->set_crumb($data['header'],'ad/form/'.$id);
			$data['page'] = $this->config->item('backendpro_template_public') . "form_schedule";
			$data['module'] = 'ad';
			$this->load->view($this->_container,$data);
		}
		else
		{
			// Save form
			if( is_null($id))
			{
				// CREATE
				// Fetch form values
				$campaign = $this->_get_campaign_details();
				$campaign['datecreated'] = date('Y-m-d H:i:s');

				$this->db->trans_begin();
				$this->ad_model->insert('Campaign',$campaign);
				$campaign_id = $this->db->insert_id();

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success',sprintf('Campaign: %s saved, Please Set Initial Schedule',$campaign['cpn_name']));
    				redirect('ad/schedule/'.$campaign_id);
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to save %s',$campaign['cpn_name']));
    				redirect('ad');
				}
			}
			else
			{
				// SAVE
				$campaign = $this->_get_schedule_details();
				$campaign['modified'] = date('Y-m-d H:i:s');

				$this->db->trans_begin();
				$this->ad_model->update('Campaign',$campaign,array('id'=>$id));

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success',sprintf('Campaign: %s updated',$campaign['cpn_name']));
  				    //redirect('ad/audience/'.$id);
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to update %s',$campaign['cpn_name']));
					redirect('ad');
				}
			}
		}
	}


    function adevent($id = NULL){
		$campaign = $this->ad_model->getSchedules(array('sch.user_id'=>$id));
		$campaign = $campaign->result_array();
		
		//print_r($campaign);
		
		$cpn_display = array();
		
		$evt_id = 1;
		
		foreach($campaign as $cpn){
		    if($cpn['start'] == $cpn['end']){
		        $cpn['id'] = $evt_id;
		        $cpn_display[] = $cpn;
		    }else{
                $start = strtotime($cpn['start']); 
                $end = strtotime($cpn['end']); 
                $date = $start;
                $cpn_temp = $cpn;
                while($date <= $end) 
                { 
    		        $cpn['id'] = $evt_id;
                    $cpn_temp['start'] = date('Y-m-d',$date);
                    $cpn_temp['end'] = date('Y-m-d',$date);
                    $cpn_display[] = $cpn_temp; 
                   //write your code here 
                   $date = strtotime("+1 day", $date); 
                } 
		    }
		    $evt_id++;
		}
		
		
		$campaign = $cpn_display;

		//print_r($campaign);

		for($i = 0;$i < count($campaign);$i++){
		    $campaign[$i]['id'] = $i;
			$campaign[$i]['start'] = $campaign[$i]['start'].'T'.$campaign[$i]['cpn_time_start'].'Z';
			$campaign[$i]['end'] = $campaign[$i]['end'].'T'.$campaign[$i]['cpn_time_end'].'Z';
			$campaign[$i]['allDay'] = ($campaign[$i]['allday'] == 1)?True:False;
		}
		print json_encode($campaign);
    }
    
    function uri($adsess = null){
        if(is_null($adsess)){
            $loc = 'http://www.google.com';
        }else{
            $loc = $this->ad_model->fetch('AdSession','id,landing_uri,cpn_id',null,array('adsessid'=>$adsess));
            
            $rs = $loc->row();
            $loc = $rs->landing_uri;
            $cpn_id = $rs->cpn_id;
            $sid = $rs->id;
        }
        
        //$this->ad_model->update('Campaign',array('actual_click'=>'actual_click'+1),array('id'=>$cpn_id));
        
        $this->ad_model->incrementField('Campaign','actual_click','id = '.$cpn_id);
        
        $this->ad_model->update('AdSession',array('clicked'=>'1'),array('id'=>$sid));
        
        redirect($loc,'location');
    }

    function img($adsess = null,$width = null,$height = null,$device = null){
        $ua = $_SERVER;
        unset($ua['HTTP_COOKIE']);
        unset($ua['argc']);
        unset($ua['argv']);
        
        $ua_text = array();
        foreach($ua as $key=>$val){
            $ua_text[] = $key.":".$val; 
        }
        //print_r($ua);
        
        $ua = implode("\r\n", $ua_text);
        
        $this->ad_model->insert('UserAgentLog',array('ua_text'=>$ua,'http_referer'=>$_SERVER['HTTP_REFERER']));
        //select campaign & image to display
        
        $cpn_id = 1;
        
        $adsess = array(
            'adsessid'=>$adsess,
            'cpn_id'=> $cpn_id,
            'image_name'=>'default_banner.jpg',
            'landing_uri'=>'http://www.bigjava.com',
            'user_id'=>2,
            'position'=>'top',
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
            /*
            'ua_width'
            'ua_height'
            'req_width'
            'req_height'
            'msisdn'
            */
        );
        $this->ad_model->insert('AdSession',$adsess);
        
        $this->ad_model->incrementField('Campaign','actual_impression','id = '.$cpn_id);
        
        
        $img = imagecreatefromjpeg($this->config->item('public_folder').'ad/default_banner.jpg');

        // Set the content type header - in this case image/jpeg
        header('Content-Type: image/jpeg');

        // Output the image
        imagejpeg($img);

        // Free up memory
        imagedestroy($img);
    }
    
    function txt(){
        print 'this is a test';
    }

	/**
	 * Delete
	 *
	 * Delete the selected users from the system
	 *
	 * @access public
	 */
	function delete()
	{
		if(FALSE === ($selected = $this->input->post('select')))
		{
			redirect('ad','location');
		}

		foreach($selected as $cpn)
		{
			if($cpn != 1)
			{	// Delete as long as its not the Administrator account
				$this->ad_model->delete('Campaign',array('id'=>$cpn));
			}
			else
			{
				flashMsg('error',$this->lang->line('userlib_administrator_delete'));
			}
		}

		flashMsg('success','Campaign(s) deleted');
		redirect('ad','location');
	}
	
	function _upload_files($cpn_id){
	    
	    $fields = $this->ad_model->fetch("BannerSize");
        if($fields->num_rows() > 0){
            $fields = $fields->result();
            foreach($fields as $size){
                $fieldname = 'upl_'.$size->width.'_'.$size->height;
        	    if(isset($_FILES[$fieldname]['name'][0])){
        	        //print $fieldname." found\r\n";
        	        $filename = $cpn_id.'_'.$size->width.'_'.$size->height;
        	        //print $filename.' '.$fieldname;
        	        $result = $this->_do_upload($fieldname,$filename,$cpn_id,$size->width,$size->height);
        	        //print_r($result);
        	    }else{
        	        //print $fieldname.' not found';
        	    }
            }
        }
	}
	
	function _do_upload($fieldname,$filename = null,$cpn_id,$width,$height,$folder = 'ad')
	{

		$result = False;

		$this->load->library('upload');
		$this->load->helper('date');

		$config['upload_path'] = $this->config->item('public_folder').$folder;
		
		//print $filename;
		
		//$config['file_name'] = $filename;
		$config['overwrite'] = TRUE;	

		//$config['allowed_types'] = '3gp|3gpp|flv|mov|wmv|avi|mpg|mpeg|mp4|mp3|mp2|bzip|tgz|tar.gz|tar|zip|xls|doc|pdf|gif|jpg|png|txt';
		$config['allowed_types'] = 'gif|jpg|png';

		$config['max_size']	= '100000';
		$config['max_width']  = '4096';
		$config['max_height']  = '4096';

		$this->upload->initialize($config);	

		if ( ! $this->upload->do_upload($fieldname))
		{
			$result = array('status'=>'error','msg'=>$this->lang->line('userlib_upload_failed').$this->upload->display_errors());
		}	
		else
		{

			$filedata = $this->upload->data($fieldname);
			$thumbname = '';

			if($filedata['is_image'] == 1){
				$mediatype ='image';
				$thumbname = 'th_'.$filedata['file_name'];
			}else if(preg_match('/video/',$filedata['file_type']) || $filedata['file_type'] =='application/octet-stream'){
				$mediatype ='video';
			}else if(preg_match('/audio/',$filedata['file_type'])){
				$mediatype ='audio';
			}else if(preg_match('/pdf$/',$filedata['file_name'])){
				$mediatype ='pdf';
			}else if(preg_match('/msword/',$filedata['file_type']) || preg_match('/doc$/',$filedata['file_name'])){
				$mediatype ='word';
			}else{
				$mediatype ='other';
			}

			$datestring = "Y-m-d H:i:s";

			$this->load->library('user_agent');

			$filedata['uid'] = $this->session->userdata('id');
			$filedata['section'] = 'uservideo';
			$filedata['fid'] = $folder;
			$filedata['mediatype'] = $mediatype;
			$filedata['timestamp'] = date($datestring,now());
			$filedata['thumbnail'] = $thumbname;
			//$filedata['postvia'] = (is_m())?'mobile':'web';
			$filedata['process'] = 0;
			$filedata['hint'] = '';
			$filedata['title'] = $filedata['file_name'];
			$filedata['scene'] = $this->input->post('scene');
			
			if($filedata['is_image']){
                $this->load->library('image_lib');

			    $config['image_library'] = 'gd2';
                $config['source_image'] = $filedata['full_path'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = $width;
                $config['height'] = $height;
                $config['new_image'] = $filedata['file_path'].$filename.strtolower($filedata['file_ext']);
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                
                $fd = array(
                    'filename'=>$filename.strtolower($filedata['file_ext']),
                    'filetype'=>$filedata['file_ext'],
                    'campaign_id'=>$cpn_id,
                    'width'=>$width,
                    'height'=>$height
                );
                
                $this->ad_model->insert('Banners',$fd);
                
			}			

			$data['fileuploaded'][] = $filedata;

			$result = array('status'=>'success','msg'=>$this->lang->line('userlib_upload_success'),'path'=>$filedata['file_path'],'file'=>$filedata['file_name'],'ext'=>$filedata['file_ext'],'fullpath'=>$filedata['full_path']);
		}

		return $result;

	}	
    
	
}
/* End of file members.php */
/* Location: ./modules/auth/controllers/admin/members.php */