<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabinet extends Client_Controller {

	public $user_orders; 
	public $user;
	public $orders_info = array();
	
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) die(redirect(base_url().'cart'));
		$this->config->load('order_config');
		
		$this->user = $this->users->get_item_by(array('id' => $this->user_id));
		
		$this->user_orders = $this->orders->get_list(array("user_id" => $this->user_id));
		
		foreach ($this->user_orders as $key => $order)
		{	
			$this->orders_info[$key] = new stdClass();	
			
			$date = new DateTime($order->date);
			
			$order_items = $this->orders_products->get_list(array("order_id" => $order->order_id));
			
			$this->orders_info[$key] = (object)array(
				"order_id" => $order->order_id,
				"status" => $order->status_id,
				"order_products" => $this->orders->get_prepared_list($order_items),
				'selects' => array(
					'delivery_id' => $this->config->item('method_delivery'),
					'payment_id' => $this->config->item('method_pay')
				),
				"date" => date_format($date, 'Y-m-d'),
				"name" => $order->user_name,
				"phone" => $order->user_phone,
				"email" => $order->user_email,
				"address" => $order->user_address
			);
				
			$status_id = $this->config->item('order_status');
			foreach ($status_id as $value => $title)
			{
				if ($this->orders_info[$key]->status == $value) $this->orders_info[$key]->status = $title;
			}	
		}
	}

	/*----------Личный кабинет----------*/
	public function index()
	{
		$data = array(
			'title' => "Личный кабинет",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'error' => "",
			'user' => $this->user,
			'top_menu' => $this->top_menu->items,
			'select_item' => "",
			'cart' => $this->cart->get_all(),
			'total_price' => $this->cart->total_price(),
			'total_qty' => $this->cart->total_qty(),
			'orders' => $this->orders_info,
			'selects' => array(
				'delivery_id' => $this->config->item('method_delivery'),
				'payment_id' => $this->config->item('method_pay')
			),
			'status_id' => $this->config->item('order_status'),
			'settings' => $this->settings->get_item_by(array('id' => 1)),
			'filials' => $this->filials->get_list(FALSE)
		);

		$this->load->view('client/cabinet.php', $data);
	}
	
	public function update_info($type)
	{
		$user = (object)$this->input->post();
		if($type == "personal")
		{
			$this->form_validation->set_rules( 'name','Имя','trim|xss_clean|required|min_length[4]|max_length[35]|callback_username_not_exists');			
			$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|valid_email|callback_email_not_exists');
			$this->form_validation->set_rules( 'phone','Телефон','trim|xss_clean|required');
			$this->form_validation->set_rules( 'address','Адрес','trim|xss_clean');
		}
		else
		{
			$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required');
			$this->form_validation->set_rules('conf_password',  'Confirm password',  'required|min_length[3]|matches[password]');
			$user->password = md5($user->password);
			unset($user->conf_password);
		}	
		
		//Валидация формы
		if($this->form_validation->run() == FALSE)
		{
		
			$data = array(
				'title' => "Личный кабинет",
				'meta_title' => "",
				'meta_keywords' => "",
				'meta_description' => "",
				'error' => "",
				'user_name' => $this->session->userdata('user_name'),
				'user' => $user,
				'top_menu' => $this->menus->top_menu,
				'cart' => $this->cart->get_all(),
				'total_price' => $this->cart->total_price(),
				'total_qty' => $this->cart->total_qty(),
				'orders' => $orders_info,
				'selects' => array(
					'delivery_id' => $this->config->item('method_delivery'),
					'payment_id' => $this->config->item('method_pay')
				),
				'status_id' => $this->config->item('order_status')
			);
			$this->load->view('client/cabinet', $data);	
		}
		else
		{
			$this->users->update($user->id, $user);
			redirect(base_url().'cabinet');
		}
	}
	
}