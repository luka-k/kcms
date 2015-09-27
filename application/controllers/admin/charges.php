<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Charges page
*
* @package		kcms
* @subpackage	controllers
* @category	    Charges
*/
class Charges extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array(
			'title' => "Начисления",
			'error' => "",
			'url' => $this->uri->uri_string()
		);
		$data = array_merge($this->standart_data, $data);
				
		$this->load->view('admin/charges.php', $data);
	}

	public function parse()
	{
		if(isset($_FILES['charges']) && $_FILES['charges']['error'] == UPLOAD_ERR_OK)
		{	
			$file = fopen($_FILES['charges']['tmp_name'], "r");

			if($file) 
			{
				while(($buffer = fgets($file)) !== false) 
				{
					$info = explode(';', $buffer);

					$child = $this->child_users->get_item_by(array('phone' => $info['0']));
					
					$data = array(
						'card_number' => $child->card_number,
						'date' => $info[9],
						'summ' => $info[3],
						'operation' => 'пополнение через сбербанк'
					);
					
					if($this->orders->insert($data))
					{
						echo '<span style="color:green">Начисление удалось.</span><br />';//ФРазу надо придумать по понятнее, что это вставка в таблицу заказов
						$this->db->where('card_number', $child->card_number);
						$card = $this->db->get('cards')->row();
					
						$new_balance = $card->card_balance + $data['summ'];
						$this->db->where('card_number', $child->card_number);
						
						if($this->db->update('cards', array('card_balance' => $new_balance)))
						{
							echo '<span style="color:green">Пополнение баланса карты №'.$child->card_number.' удалось.</span><br />';
						}
						else
						{
							echo '<span style="color:red">Пополнение баланса карты №'.$child->card_number.' не удалось.</span><br />';
						}
						
					}
					else
					{
						echo '<span style="color:red">Начисление не удалось.</span><br />';//Аналогично
					}
				}
			}
			fclose($file);
			
			echo "<a href='".base_url()."admin'>На главную</a>";
		}
	}
}