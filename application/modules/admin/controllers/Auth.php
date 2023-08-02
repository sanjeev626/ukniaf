<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->load->model('general_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
	}

	function register(){
		echo "here";exit;
    }
	// redirect if needed, otherwise display the user list

	function index()
	{
		//echo "here we are";exit;		
        if (!$this->ion_auth->logged_in())
		{  
			// redirect them to the login page
			//redirect('auth/login', 'refresh');
			redirect('core/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			redirect('admin/dashboard', 'refresh');
			//return show_error('You must be an administrator to view this page.');
		}
		else
		{ 
			// set the flash data error message if there is one

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');



			//list the users

			$this->data['users'] = $this->ion_auth->users()->result();

			foreach ($this->data['users'] as $k => $user)

			{

				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();

			}

			

			$this->data['title'] = '~User Management~';
	        $this->data['page_header'] = 'User Management';
	        $this->data['page_header_icone'] = 'fa-user';
	        $this->data['parent_nav'] = '';
	        $this->data['nav'] = 'user';
	        $this->data['panel_title'] = 'User Management';

	       // $this->data['allmodules'] = $this->general_model->get_all_modules();
	        $this->data['main'] = 'core/index';

			$this->_render_page('admin/home', $this->data);
		}

	}



	// log the user in

	function login()
	{ 
		$this->data['title'] = $this->lang->line('login_heading');

		//validate form input

		$this->form_validation->set_rules('identity', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');



		if ($this->form_validation->run() == true)
		{

			// check to see if the user is logging in

			// check for "remember me"

			//echo $this->input->post('identity');echo "<br>";

			//echo $this->input->post('password');exit;

			$remember=1;

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))

			{

				//if the login is successful

				//redirect them back to the home page
				$user = $this->ion_auth->user()->row();
				//$this->session->set_userdata('user_type', $user->user_type);
				$role = $this->general_model->getValue('role','tbl_position','id='.$user->position_id);
				$this->session->set_userdata('component_id', $user->component_id);
				$this->session->set_userdata('fullname', $user->full_name);
				$this->session->set_userdata('role', $role);
				$this->session->set_flashdata('success', $this->ion_auth->messages());
				//print_r($_SESSION);
				//redirect('core/', 'refresh');
				redirect('admin/dashboard','refresh');

			}

			else

			{

				// if the login was un-successful

				// redirect them back to the login page
				//$error = "Incorrect username/password combination.<br>Please try again or click Forgot password to reset it.";
				$error = "Incorrect username/password combination.<br>Please try again.";
				//$error = $this->ion_auth->errors();
				//$error .="<br>Please try again or click Forgot password to reset it.";
				$this->session->set_flashdata('error', $error);
				//print_r($_SESSION);
				redirect('core/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries

			}

		}
		else
		{

			// the user is not logging in so display the login page

			// set the flash data error message if there is one

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');



			$this->data['identity'] = array('name' => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);

			$this->data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
			);



			$this->_render_page('core/login', $this->data);
		}

	}



	// log the user out

	function logout()
	{
		$this->data['title'] = "Logout";



		// log the user out

		$logout = $this->ion_auth->logout();



		// redirect them to the login page

		$this->session->set_flashdata('message', $this->ion_auth->messages());

		redirect('core/login', 'refresh');

	}



	// change password

	function change_password()
	{
		$this->form_validation->set_rules('password_old', 'Old Password', 'required');
		$this->form_validation->set_rules('password', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'New Password confirm', 'required');
		if (!$this->ion_auth->logged_in())
		{
			redirect('core/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();
		//print_r($_SESSION);
		if ($this->form_validation->run() == false)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['min_password_length'] = 8;//$this->config->item('ion_auth','min_password_length');
			$this->data['title'] = '~Change Password~';
       	    $this->data['page_header'] = 'Change Password';
            $this->data['page_header_icone'] = 'fa-pencil';
            $this->data['parent_nav'] = '';
            $this->data['nav'] = 'dashboard';
            $this->data['panel_title'] = 'Admin Password Change';
            $this->data['main'] = 'core/profile';
			$this->_render_page('home', $this->data);
		}
		else
		{
			$identity = $this->session->userdata('identity');
			$change = $this->ion_auth->change_password($identity, $this->input->post('password_old'), $this->input->post('password'));
			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('success', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('admin/auth/profile', 'refresh');
			}
		}
	}

	// forgot password
	function forgot_password()
	{

		// setting validation rules by checking whether identity is username or email

		if($this->config->item('identity', 'ion_auth') != 'email' )
		{

		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{

		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}





		if ($this->form_validation->run() == false)
		{

			$this->data['type'] = $this->config->item('identity','ion_auth');

			// setup the input

			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
			);



			if ( $this->config->item('identity', 'ion_auth') != 'email' ){

				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');

			}

			else

			{

				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');

			}



			// set any errors and display the form

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->_render_page('core/forgot_password', $this->data);
		}
		else
		{

			$identity_column = $this->config->item('identity','ion_auth');

			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();



			if(empty($identity)) {



	            		if($this->config->item('identity', 'ion_auth') != 'email')

		            	{

		            		$this->ion_auth->set_error('forgot_password_identity_not_found');

		            	}

		            	else

		            	{

		            	   $this->ion_auth->set_error('forgot_password_email_not_found');

		            	}



		                $this->session->set_flashdata('message', $this->ion_auth->errors());

                		redirect("core/forgot_password", 'refresh');

            		}



			// run the forgotten password method to email an activation code to the user

			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});



			if ($forgotten)

			{

				// if there were no errors

				$this->session->set_flashdata('success', $this->ion_auth->messages());

				redirect("core/login", 'refresh'); //we should display a confirmation page here instead of the login page

			}

			else

			{

				$this->session->set_flashdata('message', $this->ion_auth->errors());

				redirect("core/forgot_password", 'refresh');

			}

		}

	}



	// reset password - final step for forgotten password

	public function reset_password($code = NULL)
	{

		if (!$code)
		{

			show_404();
		}



		$user = $this->ion_auth->forgotten_password_check($code);



		if ($user)
		{

			// if the code is valid then display the password reset form



			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');

			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');



			if ($this->form_validation->run() == false)

			{

				// display the form



				// set the flash data error message if there is one

				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');



				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');

				$this->data['new_password'] = array(

					'name' => 'new',

					'id'   => 'new',

					'type' => 'password',

					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',

				);

				$this->data['new_password_confirm'] = array(

					'name'    => 'new_confirm',

					'id'      => 'new_confirm',

					'type'    => 'password',

					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',

				);

				$this->data['user_id'] = array(

					'name'  => 'user_id',

					'id'    => 'user_id',

					'type'  => 'hidden',

					'value' => $user->id,

				);

				$this->data['csrf'] = $this->_get_csrf_nonce();

				$this->data['code'] = $code;



				// render

				$this->_render_page('core/reset_password', $this->data);

			}

			else

			{

				// do we have a valid request?

				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))

				{



					// something fishy might be up

					$this->ion_auth->clear_forgotten_password_code($code);



					show_error($this->lang->line('error_csrf'));



				}

				else

				{

					// finally change the password

					$identity = $user->{$this->config->item('identity', 'ion_auth')};



					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));



					if ($change)

					{

						// if the password was successfully changed

						$this->session->set_flashdata('success', $this->ion_auth->messages());

						redirect("core/login", 'refresh');

					}

					else

					{

						$this->session->set_flashdata('message', $this->ion_auth->errors());

						redirect('core/reset_password/' . $code, 'refresh');

					}

				}

			}

		}
		else
		{

			// if the code is invalid then send them back to the forgot password page

			$this->session->set_flashdata('message', $this->ion_auth->errors());

			redirect("core/forgot_password", 'refresh');
		}

	}





	// activate the user

	function activate($activation_code)
	{
		//print_r($_POST);
		$user = $this->general_model->getArray('*','users','activation_code="'.$activation_code.'"');
		if(isset($_POST['btnActivate'])){
			//print_r($_POST);
			if(isset($_POST['password']) && isset($_POST['confirm_password']) && $_POST['password']==$_POST['confirm_password']){
				$message = $this->ion_auth->activate($_POST['password'], $activation_code, $user->salt);
				$data['message'] = $message;
		        $this->session->set_flashdata('success', $message);
				redirect("core/login", 'refresh');
			}
			else{
				$error = "Password confirmation doesn't match. <br>Please try again.";	
		        $this->session->set_flashdata('error', $error);
				redirect("core/activate/".$activation_code, 'refresh');			
			}
		}
        
        $check = $this->general_model->getCount('users','activation_code="'.$activation_code.'"');
        //echo "Activation page : ".$check;
        $data['user'] = $user;
        $data['check'] = $check;
        $data['activation_code'] = $activation_code;
        $this->_render_page('core/activate', $data);
        //$this->session->set_flashdata('message', 'Your account has been activated.');
		//redirect("core/login", 'refresh');

	}



	// deactivate the user

	function deactivate($id = NULL)
	{

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{

			// redirect them to the home page because they must be an administrator to view this

			return show_error('You must be an administrator to view this page.');
		}



		$id = (int) $id;
		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');



		if ($this->form_validation->run() == FALSE)
		{

			// insert csrf check

			$this->data['csrf'] = $this->_get_csrf_nonce();

			$this->data['user'] = $this->ion_auth->user($id)->row();



			$this->data['title'] = '~User Management~';
	        $this->data['page_header'] = 'User Management';
	        $this->data['page_header_icone'] = 'fa-user';
	        $this->data['parent_nav'] = '';
	        $this->data['nav'] = 'user';
	        $this->data['panel_title'] = 'User Management';

	        //$this->data['allmodules'] = $this->general_model->get_all_modules();
	        $this->data['main'] = 'core/deactivate_user';



			$this->_render_page('home', $this->data);
		}
		else
		{

			// do we really want to deactivate?

			if ($this->input->post('confirm') == 'yes')

			{



				// do we have a valid request?  //$this->_valid_csrf_nonce() === FALSE || 

				if ($id != $this->input->post('id'))

				{

					show_error($this->lang->line('error_csrf'));

				}



				// do we have the right userlevel?

				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())

				{

					$this->ion_auth->deactivate($id);

				}

			}



			// redirect them back to the auth page

			redirect('core', 'refresh');
		}

	}



	// create a new user

	function create_user()

    {

        $this->data['title'] = $this->lang->line('create_user_heading');



        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())

        {

            redirect('core', 'refresh');

        }



        $tables = $this->config->item('tables','ion_auth');

        $identity_column = $this->config->item('identity','ion_auth');

        $this->data['identity_column'] = $identity_column;



        // validate form input

        $this->form_validation->set_rules('full_name', $this->lang->line('create_user_validation_fname_label'), 'required');

        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');

        if($identity_column!=='email')

        {

            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');

        }

        else

        {

            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');

        }

        $this->form_validation->set_rules('contact_number', $this->lang->line('create_user_validation_contact_number_label'), 'trim');

        $this->form_validation->set_rules('company_name', $this->lang->line('create_user_validation_company_name_label'), 'trim');

        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');

        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');



        if ($this->form_validation->run() == true)

        {

            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');



            $additional_data = array(

                'full_name' => $this->input->post('full_name'),

                'company_name'    => $this->input->post('company_name'),

                'contact_number'      => $this->input->post('contact_number'),

            );

        }

        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))

        {

            // check to see if we are creating the user

            // redirect them back to the admin page

            $this->session->set_flashdata('message', $this->ion_auth->messages());

            redirect("core", 'refresh');

        }

        else

        {

            // display the create user form

            // set the flash data error message if there is one

            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));



            $this->data['full_name'] = array(

                'name'  => 'full_name',

                'id'    => 'full_name',

                'type'  => 'text',

                'value' => $this->form_validation->set_value('full_name'),

            );

            /*$this->data['last_name'] = array(

                'name'  => 'last_name',

                'id'    => 'last_name',

                'type'  => 'text',

                'value' => $this->form_validation->set_value('last_name'),

            );*/

            $this->data['identity'] = array(

                'name'  => 'identity',

                'id'    => 'identity',

                'type'  => 'text',

                'value' => $this->form_validation->set_value('identity'),

            );
            $this->data['email'] = array(

                'name'  => 'email',

                'id'    => 'email',

                'type'  => 'text',

                'value' => $this->form_validation->set_value('email'),

            );
            $this->data['company_name'] = array(

                'name'  => 'company_name',

                'id'    => 'company_name',

                'type'  => 'text',

                'value' => $this->form_validation->set_value('company_name'),

            );
            $this->data['contact_number'] = array(

                'name'  => 'contact_number',

                'id'    => 'contact_number',

                'type'  => 'text',

                'value' => $this->form_validation->set_value('contact_number'),

            );
            $this->data['password'] = array(

                'name'  => 'password',

                'id'    => 'password',

                'type'  => 'password',

                'value' => $this->form_validation->set_value('password'),

            );
            $this->data['password_confirm'] = array(

                'name'  => 'password_confirm',

                'id'    => 'password_confirm',

                'type'  => 'password',

                'value' => $this->form_validation->set_value('password_confirm'),

            );



            $this->data['title'] = '~User Management~';
	        $this->data['page_header'] = 'User Management';
	        $this->data['page_header_icone'] = 'fa-user';
	        $this->data['parent_nav'] = '';
	        $this->data['nav'] = 'user';
	        $this->data['panel_title'] = 'User Management';

	        //$this->data['allmodules'] = $this->general_model->get_all_modules();
	        $this->data['main'] = 'core/create_user';
            $this->_render_page('home', $this->data);

        }

    }



	// edit a user

	function profile()
	{
		/*$user = $this->ion_auth->user()->row();
		print_r($user);
*/
		$id = $this->ion_auth->user()->row()->id;
		//echo "User ID = ".$id;
		
		$query = $this->db->select('id, email, full_name, address, contact_number')
		                  ->where('id', $id)
		                  ->limit(1)
		                  ->get('users');

		$user = $query->row();

		/*$id = $user->id;*/

		$this->data['title'] = $this->lang->line('edit_user_heading');

		$this->data['title'] = 'User Management~';
        $this->data['page_header'] = 'User Management';
        $this->data['page_header_icone'] = 'fa-user';
        $this->data['parent_nav'] = '';
        $this->data['nav'] = 'user';
        $this->data['user_info'] = $user;
        $this->data['panel_title'] = 'User Management';

        //$this->data['allmodules'] = $this->general_model->get_all_modules();
        $this->data['main'] = 'core/profile';
		$this->_render_page('home', $this->data);

	}



	// create a new group

	function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');



		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{

			redirect('core', 'refresh');
		}



		// validate form input

		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');



		if ($this->form_validation->run() == TRUE)
		{

			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));

			if($new_group_id)

			{

				// check to see if we are creating the group

				// redirect them back to the admin page

				$this->session->set_flashdata('message', $this->ion_auth->messages());

				redirect("core", 'refresh');

			}

		}
		else
		{

			// display the create group form

			// set the flash data error message if there is one

			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));



			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);

			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);



			$this->data['title'] = '~User Management~';
	        $this->data['page_header'] = 'User Management';
	        $this->data['page_header_icone'] = 'fa-user';
	        $this->data['parent_nav'] = '';
	        $this->data['nav'] = 'user';
	        $this->data['panel_title'] = 'User Management';

	        //$this->data['allmodules'] = $this->general_model->get_all_modules();
	        $this->data['main'] = 'core/create_group';

			$this->_render_page('home', $this->data);
		}

	}



	// edit a group

	function edit_group($id)
	{

		// bail if no group id given

		if(!$id || empty($id))
		{

			redirect('core', 'refresh');
		}



		$this->data['title'] = $this->lang->line('edit_group_title');



		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{

			redirect('core', 'refresh');
		}



		$group = $this->ion_auth->group($id)->row();



		// validate form input

		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');



		if (isset($_POST) && !empty($_POST))
		{

			if ($this->form_validation->run() === TRUE)

			{

				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);



				if($group_update)

				{

					$this->session->set_flashdata('success', $this->lang->line('edit_group_saved'));

				}

				else

				{

					$this->session->set_flashdata('message', $this->ion_auth->errors());

				}

				redirect("core", 'refresh');

			}

		}



		// set the flash data error message if there is one

		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));



		// pass the user to the view

		$this->data['group'] = $group;
		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';
		$this->data['group_name'] = array(

			'name'    => 'group_name',

			'id'      => 'group_name',

			'type'    => 'text',

			'value'   => $this->form_validation->set_value('group_name', $group->name),

			$readonly => $readonly,

		);
		$this->data['group_description'] = array(

			'name'  => 'group_description',

			'id'    => 'group_description',

			'type'  => 'text',

			'value' => $this->form_validation->set_value('group_description', $group->description),

		);



			$this->data['title'] = '~User Management~';
	        $this->data['page_header'] = 'User Management';
	        $this->data['page_header_icone'] = 'fa-user';
	        $this->data['parent_nav'] = '';
	        $this->data['nav'] = 'user';
	        $this->data['panel_title'] = 'User Management';

	        //$this->data['allmodules'] = $this->general_model->get_all_modules();
	        $this->data['main'] = 'core/edit_group';
		$this->_render_page('home', $this->data);

	}





	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20); 

		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);



		return array($key => $value);

	}



	function _valid_csrf_nonce()
	{

		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&

			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{

			return TRUE;
		}
		else
		{

			return FALSE;
		}

	}



	function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense

	{



		$this->viewdata = (empty($data)) ? $this->data: $data;
		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);



		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true

	}



}

