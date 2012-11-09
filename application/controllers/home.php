<?php

class Home_Controller extends Base_Controller {

	public $restful = true;

	public function get_index() {
		return View::make( 'home.index' );
	}

	public function get_marker() {
		$clients = User::all();
		$data = array();

		foreach ( $clients as $client ) {
			$data[$client->id] = $client->username;
		}

		if ( Auth::user()->group == 2 ) {
			$markers = DB::table( 'markers' )
			->join( 'users' , 'markers.user_id', '=', 'users.id' )
			->where( 'user_id', '=', Auth::user()->id )
			->paginate( 13, array(
					'markers.id',
					'markers.name',
					'markers.address',
					'markers.lat',
					'markers.lng',
					'markers.type',
					'users.username'
				) );

			return View::make( 'extern.markers-list-client' )
			->with( 'markers', $markers )
			->with( 'clients', $data );
		}
		else {
			$markers = DB::table( 'markers' )
			->join( 'users' , 'markers.user_id', '=', 'users.id' )
			->paginate( 13, array(
					'markers.id',
					'markers.name',
					'markers.address',
					'markers.lat',
					'markers.lng',
					'markers.type',
					'users.username'
				) );

			return View::make( 'home.markers-list' )
			->with( 'markers', $markers )
			->with( 'clients', $data );
		}
	}

	public function post_marker() {
		$id = Input::get( 'client' );
		$markers = DB::table( 'markers' )
		->join( 'users' , 'markers.user_id', '=', 'users.id' )
		->where( 'user_id', '=', $id )
		->paginate( 13, array(
				'markers.id',
				'markers.name',
				'markers.address',
				'markers.lat',
				'markers.lng',
				'markers.type',
				'users.username'
			) );

		$clients = User::all();
		$data = array();

		foreach ( $clients as $client ) {
			$data[$client->id] = $client->username;
		}
		return View::make( 'home.markers-list' )
		->with( 'markers', $markers )
		->with( 'clients', $data )
		->with( 'active_client', $id );
	}


	public function get_new_marker() {
		$clients = User::all();

		$data = array();
		foreach ( $clients as $client ) {
			$data[$client->id] = $client->username;
		}
		if ( Auth::user()->group == 2 ) {
			return View::make( 'extern.add-marker-client' )
			->with( 'clients', $data );
		}
		else {
			return View::make( 'home.add-marker' )
			->with( 'clients', $data );
		}

	}
	public function post_new_marker() {
		$input = Input::all();
		$file = Input::file( 'img_input' );
		$rules = array(
			'name' => 'required|max:150|unique:markers',
			'address' => 'required|max:200|unique:markers',
			'lat' => 'required|numeric',
			'lng' => 'required|numeric',
			'type' => 'required|alpha',
			'img_input' => 'mimes:jpg,gif,png,jpeg|image'
		);

		$v = Validator::make( $input, $rules );

		if ( $v->fails() ) {
			return Redirect::to_action( 'home@new_marker' )->with_errors( $v )->with_input();
		}
		else {
			// save thumbnail
			if ( !empty( $file['name'] ) ) {
				$success = Resizer::open( $file )
				->resize( 120 , 100 , 'landscape' )
				->save( 'public/img/uploads/'.$file['name'] , 90 );
			}
			URLify::add_chars ( array (
					'á' => '&aacute;',
					'à' => '&agrave;',
					'ä' => '&auml;',
					'Á' => '&Aacute;',
					'À' => '&Agrave;',
					'â' => '&acirc;',
					'Â' => '&Acirc;',
					'ã' => '&atilde;',
					'Ã' => '&Atilde;',
					'Ä' => '&Auml;',
					'Ç' => '&Ccedil;',
					'ç' => '&ccedil;',
					'é' => '&eacute;',
					'É' => '&Eacute;',
					'è' => '&egrave;',
					'È' => '&Egrave;',
					'ê' => '&ecirc;',
					'Ê' => '&Ecirc;',
					'ë' => '&euml;',
					'Ë' => '&Euml;',
					'ü' => '&uuml;',
					'Ü' => '&Uuml;',
					'û' => '&ucirc;',
					'Û' => '&Ucirc;',
					'ú' => '&uacute;',
					'Ú' => '&Uacute;',
					'ù' => '&ugrave;',
					'Ù' => '&Ugrave;',
					'ó' => '&oacute;',
					'Ó' => '&Oacute;',
					'ò' => '&ograve;',
					'Ò' => '&Ograve;',
					'ô' => '&ocirc;',
					'Ô' => '&Ocirc;',
					'ö' => '&ouml;',
					'Ö' => '&Ouml;',
					'ß' => '&szlig;',
					'ÿ' => '&yuml;',
				) );

			$marker = new Marker();
			$marker->name = URLify::downcode( $input['name'] );
			$marker->address = URLify::downcode( $input['address'] );
			$marker->lat = $input['lat'];
			$marker->lng = $input['lng'];
			$marker->type = URLify::downcode( $input['type'] );
			$marker->user_id = ( Auth::user()->group == 2 ) ? Auth::user()->id : $input['client'];
			$marker->rem1 = URLify::downcode( Input::get( 'rem1', '' ) );
			$marker->rem2 = URLify::downcode( Input::get( 'rem2', '' ) );
			$marker->rem3 = URLify::downcode( Input::get( 'rem3', '' ) );
			$marker->rem4 = URLify::downcode( Input::get( 'rem4', '' ) );
			$marker->rem5 = URLify::downcode( Input::get( 'rem5', '' ) );
			if ( !empty( $file['name'] ) )
				$marker->img_url = '/img/uploads/' . $file['name'];
			$marker->save();

			return Redirect::to_action( 'home@new_marker' )->with( 'message', 'Marker added!' );
		}
	}

	public function get_edit_marker( $id ) {
		$marker = Marker::find( $id );
		$clients = User::all();
		$data = array();

		foreach ( $clients as $client ) {
			$data[$client->id] = $client->username;
		}
		if ( Auth::user()->group == 2 ) {
			return View::make( 'extern.edit-marker-client' )->with( 'marker', $marker )->with( 'clients', $data );
		}
		else {
			return View::make( 'home.edit-marker' )->with( 'marker', $marker )->with( 'clients', $data );
		}
	}

	public function post_edit_marker( $id ) {
		$input = Input::all();
		$file = Input::file( 'img_input' );
		$rules = array(
			'name' => 'required|max:150',
			'address' => 'required|max:200',
			'lat' => 'required|numeric',
			'lng' => 'required|numeric',
			'type' => 'required|alpha',
			'img_input' => 'mimes:jpg,gif,png,jpeg|image'
		);
		$v = Validator::make( $input, $rules );
		if ( $v->fails() ) {
			return Redirect::to_action( 'home@edit_marker/'.$id )->with_errors( $v );
		}
		else {
			// save thumbnail
			if ( !empty( $file['name'] ) ) {
				$success = Resizer::open( $file )
				->resize( 120 , 100 , 'landscape' )
				->save( 'public/img/uploads/'.$file['name'] , 90 );

			}

			URLify::add_chars ( array (
					'á' => '&aacute;',
					'à' => '&agrave;',
					'ä' => '&auml;',
					'Á' => '&Aacute;',
					'À' => '&Agrave;',
					'â' => '&acirc;',
					'Â' => '&Acirc;',
					'ã' => '&atilde;',
					'Ã' => '&Atilde;',
					'Ä' => '&Auml;',
					'Ç' => '&Ccedil;',
					'ç' => '&ccedil;',
					'é' => '&eacute;',
					'É' => '&Eacute;',
					'è' => '&egrave;',
					'È' => '&Egrave;',
					'ê' => '&ecirc;',
					'Ê' => '&Ecirc;',
					'ë' => '&euml;',
					'Ë' => '&Euml;',
					'ü' => '&uuml;',
					'Ü' => '&Uuml;',
					'û' => '&ucirc;',
					'Û' => '&Ucirc;',
					'ú' => '&uacute;',
					'Ú' => '&Uacute;',
					'ù' => '&ugrave;',
					'Ù' => '&Ugrave;',
					'ó' => '&oacute;',
					'Ó' => '&Oacute;',
					'ò' => '&ograve;',
					'Ò' => '&Ograve;',
					'ô' => '&ocirc;',
					'Ô' => '&Ocirc;',
					'ö' => '&ouml;',
					'Ö' => '&Ouml;',
					'ß' => '&szlig;',
					'ÿ' => '&yuml;',
				) );

			$marker = Marker::where( 'id', '=', $id )->first();
			$marker->name = URLify::downcode( $input['name'] );
			$marker->address = URLify::downcode( $input['address'] );
			$marker->lat = $input['lat'];
			$marker->lng = $input['lng'];
			$marker->type = $input['type'];
			$marker->user_id = ( Auth::user()->group == 2 ) ? Auth::user()->id : $input['client'];
			$marker->rem1 = URLify::downcode( Input::get( 'rem1', '' ) );
			$marker->rem2 = URLify::downcode( Input::get( 'rem2', '' ) );
			$marker->rem3 = URLify::downcode( Input::get( 'rem3', '' ) );
			$marker->rem4 = URLify::downcode( Input::get( 'rem4', '' ) );
			$marker->rem5 = URLify::downcode( Input::get( 'rem5', '' ) );
			if ( !empty( $file['name'] ) )
				$marker->img_url = '/img/uploads/' . $file['name'];
			$marker->save();

			return Redirect::to_action( 'home@edit_marker/'.$id )->with( 'message', 'Marker updated!' );
		}

	}

	public function get_delete_marker( $id ) {
		Marker::find( $id )->delete();
		if ( Session::has( 'client_name_s' ) ) {
			return Redirect::to_action( 'home@marker_'.Session::get( 'client_name_s' ) )->with( 'message', 'Marker deleted!' );
		}
		else {
			return Redirect::to_action( 'home@marker' )->with( 'message', 'Marker deleted!' );
		}
	}

	public function get_delete_session() {
		Session::flush();
		return Redirect::to_action( 'home@index' );
	}

}
