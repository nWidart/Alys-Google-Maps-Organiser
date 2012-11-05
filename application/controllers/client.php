<?php

class Client_Controller extends Base_Controller
{
	public $restful = true;

	public function get_index()
	{

	}

	public function get_listing()
	{
		$clients = User::all();
		return View::make('client.client-list')
			->with('clients', $clients);
	}

	public function get_new_client()
	{
		return View::make('client.add-client');
	}

	public function post_new_client()
	{
		$input = Input::get();
		$rules = array(
			'username' => 'required|max:100|alpha_dash|unique:users',
			'password' => 'required|max:100|alpha_dash',
		);
		$v = Validator::make($input, $rules);

		if ( $v->fails() )
		{
			return Redirect::to_action('client@new_client')->with_errors($v);
		}
		else
		{
			$client = new User();
				$client->username = $input['username'];
				$client->password = Hash::make($input['password']);
				$client->group = $input['group'];
			$client->save();
			return Redirect::to_action('client@listing')
				->with('message', 'Client added!')
				->with('hint', true);
		}
	}

	public function get_edit_client($id)
	{
		$client = User::find($id);
		// $marker_count = DB::table('users')
		// 	->join('markers', 'users.id', '=', 'markers.user_id')
		// 	->where('user.id', '=', $id)
		// 	->count();
		return View::make('client.edit-client')
			->with('client', $client);
	}
	public function post_edit_client($id)
	{
		$input = Input::all();
		$rules = array(
			'username' => 'required|max:100|alpha_num',
			'password' => 'max:100|alpha_num',
		);
		$v = Validator::make($input, $rules);

		if ( $v->fails() )
		{
			return Redirect::to_action('client@edit_client')->with_errors($v);
		}
		else
		{
			$client = User::where('id', '=', $id)->first();
				$client->username = $input['username'];
				if ( !empty($input['password']) )
				{
					$client->password = Hash::make($input['password']);
				}
			$client->save();
			return Redirect::to_action('client@edit_client/'.$id)->with('message', 'Client modified!');
		}
	}

	public function get_delete_client($id)
	{
		User::find($id)->delete();

		return Redirect::to_action('client@listing')->with('message', 'Client deleted');
	}

}