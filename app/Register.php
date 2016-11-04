<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model {

	public function user(){
		return $this->belongsTo('App\User');
	}

    public function create_entrytable($user){
        
    }

 }

	//var $x = document.getElementById('demo');

	//public function getLocation() {
    //	if (navigator.geolocation) {
    //	   	navigator.geolocation.getCurrentPosition(showPosition);
    //	}
    //	else {
      //  	x.innerHTML = "Geolocation is not supported by this browser.";
    	//}

    	//return x.innerHTML;
	//}

	//public function showPosition(position) {
    //	x.innerHTML = "Latitude: " + position.coords.latitude + 
   	//	"<br>Longitude: " + position.coords.longitude; 
	//}
