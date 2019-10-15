$(document).ready(function(){


// Your web app's Firebase configuration
var firebaseConfig = {
apiKey: "AIzaSyBspTIy_ytS0tTtDMrRC9qc70_BTV8oNx0",
authDomain: "test-22be0.firebaseapp.com",
databaseURL: "https://test-22be0.firebaseio.com",
projectId: "test-22be0",
storageBucket: "test-22be0.appspot.com",
messagingSenderId: "33253274226",
appId: "1:33253274226:web:faf000c88608c61c5a88eb",
measurementId: "G-EJPVW4XW3F"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
firebase.analytics();






/**
* Driver pop pu
*/
// read data on change
var isDriver = $("#hidden-is-driver").val();
var starCountRef = firebase.database().ref('driver-pop-up');
starCountRef.on('child_changed', function(snapshot) {
// for now showing pop up for all driver
alert("Driver pop up");
if (isDriver == 1) {
// code to show 

}

// here we need to calculate the distance and show pop up
// var changedLat = '';
// changedLat = changedLat+'<li>'+snapshot.val().lat+'</li>';
// $('#all-msg').html(changedLat);
});



/**
* Order placed by customer
*/

var newOfferId = $("#hidden-restaurant-offer-customer").val();
var isAccepted = $("#hidden-is-accepted").val();
if (isAccepted == 0) {
var database = firebase.database().ref('driver-pop-up').child(newOfferId).set({
attempt: 0,
anyResponse: false,
log: $("#hidden-lon").val(),
lat: $("#hidden-lat").val()
});

firebase.database().ref('driver-pop-up').child(newOfferId).update({
attempt: 1
});	
}




});