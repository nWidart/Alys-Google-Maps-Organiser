<?php

class Client_Controller extends Base_Controller
{
	public $restful = true;

	public function get_index()
	{

	}

	public function get_listing()
	{
		$clients = Client::all();
		return View::make('client.client-list')->with('clients', $clients);
	}

	public function get_new_client()
	{
		return View::make('client.add-client');
	}

	public function post_new_client()
	{
		$input = Input::get();
		$rules = array(
			'societe' => 'required|max:100|unique:clients',
			'nom' => 'required|max:100|alpha',
		);
		$v = Validator::make($input, $rules);

		if ( $v->fails() )
		{
			return Redirect::to_action('client@new_client')->with_errors($v);
		}
		else
		{
			$client = new Client();
				$client->societe = $input['societe'];
				$client->nom = $input['nom'];
			$client->save();
			return Redirect::to_action('client@listing')->with('message', 'Client added!');
		}
	}

	public function get_edit_client($id)
	{
		$client = Client::find($id);
		$marker_count = DB::table('clients')
			->join('markers', 'clients.id', '=', 'markers.client_id')
			->where('clients.id', '=', $id)
			->count();


		return View::make('client.edit-client')
			->with('client', $client)
			->with('marker_count', $marker_count);
	}
	public function post_edit_client($id)
	{
		$input = Input::all();
		$rules = array(
			'societe' => 'required|max:100',
			'nom' => 'required|max:100|alpha',
		);
		$v = Validator::make($input, $rules);

		if ( $v->fails() )
		{
			return Redirect::to_action('client@edit_client')->with_errors($v);
		}
		else
		{
			$client = Client::where('id', '=', $id)->first();
				$client->societe = $input['societe'];
				$client->nom = $input['nom'];
			$client->save();
			return Redirect::to_action('client@edit_client/'.$id)->with('message', 'Client modified!');
		}
	}

	public function get_delete_client($id)
	{
		Client::find($id)->delete();

		return Redirect::to_action('client@listing')->with('message', 'Client deleted');
	}

}