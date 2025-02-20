@extends('backend.layouts.master')
@section("title","Chat with Buyer")
@push('css')
   
    <link rel="stylesheet" href="{{asset('backend/vendor_chat.css')}}">
    <style>
        ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
            color: #F16044;
            margin-left: 10px;
        }
        ::-moz-placeholder { /* Firefox 19+ */
            color: #F16044;
            margin-left: 10px;
        }
        :-ms-input-placeholder { /* IE 10+ */
            color: #F16044;
            margin-left: 10px;
        }
        :-moz-placeholder { /* Firefox 18- */
            color: #F16044;
            margin-left: 10px;
        }
    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chat for <span style="font-size: 16px">({{$saleRecord->product->name}}) <img src="{{url($saleRecord->product->thumbnail_img)}}" width="50" height="50"></span></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">CHAT</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content " style="width: 80%">
        <div>
            <h3>Bid Information</h3>
            <table class="table table-bordered">
                <thead class="text-center">
                <tr>
                    <th>Buyer</th>
                    <th>Seller</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-general">
                        Name: {{$buyerDetails->name}}<br>
                        Phone: <a href="tel:{{$buyerDetails->country_code.$buyerDetails->phone}}">{{$buyerDetails->country_code.$buyerDetails->phone}}</a><br>
                        Address: {{$buyerDetails->address}}
                    </td>
                    <td class="text-general">
                        Name: {{$sellerDetails->name}}<br>
                        Phone: <a href="tel:{{$sellerDetails->country_code.$sellerDetails->phone}}">{{$sellerDetails->country_code.$sellerDetails->phone}}</a><br>
                        Address: {{$sellerDetails->address}}
                    </td>
                </tr>
                <tr>
                    <td>Quantity:</td>
                    <td >{{$saleRecord->product->quantity}}tk</td>
                </tr>
                <tr>
                    <td>Bid Unit Price:</td>
                    <td >{{$saleRecord->productBid->unit_bid_price}}tk</td>
                </tr>
                <tr>
                    <td>Bid Total Price:</td>
                    <td>{{$saleRecord->productBid->total_bid_price}}tk</td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="row">
                        <div class="col-6">
                            <div class="card card-primary">
                                <div class="card-header image">
                                    <h3 class="card-title">
                                <span class="col-md-12">
                                <img class="incoming_msg_img img-circle elevation-2 border-box img-rounded" src=" {{!empty($buyerDetails->avatar_original) ? asset($buyerDetails->avatar_original) : "https://ptetutorials.com/images/user-profile.png"}} " alt="Buyer Image" width="15px" height="15px">
                            </span> {{$buyerDetails->name}}
                                    </h3>
                                </div>
                                <div class="messaging">
                                    <div class="inbox_msg">
                                        <div class="mesgs">
                                            <div class="msg_history_buyer" style="height: 400px">
                                            </div>
                                            <div class="type_msg" style="position: sticky">
                                                <div class="input_msg_write">
                                                    <input type="text" id="msg_send_btn_buyer_keypess" class="write_msg_buyer" placeholder="Type a message" name="chat_message" required/>
                                                    <button class="msg_send_btn_buyer" id="msg_send_btn_buyer"type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                       
                        <div class="col-6">
                            <!-- jquery validation -->
                            <div class="card card-primary">
                                <div class="card-header image">
                                    <h3 class="card-title">
                                <span class="col-md-12">
                                <img class="incoming_msg_img img-circle elevation-2 border-box img-rounded" src=" {{!empty($sellerDetails->avatar_original) ? asset($sellerDetails->avatar_original) : "https://ptetutorials.com/images/user-profile.png"}} " alt="Seller Image" width="15px" height="15px">
                            </span> {{$sellerDetails->name}}
                                    </h3>
                                </div>
                                <div class="messaging">
                                    <div class="inbox_msg">
                                        <div class="mesgs">
                                            <div class="msg_history" style="height: 400px">
                                            </div>
                                            <div class="type_msg" style="position: sticky">
                                                <div class="input_msg_write">
                                                    <input type="text" id="msg_send_btn_keypress" class="write_msg" placeholder="Type a message" name="chat_message" required/>
                                                    <button class="msg_send_btn" id="msg_send_btn" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->



@stop
@push('js')
    
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-app.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-firestore.js"></script>
    <script>
        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        var firebaseConfig = {
            apiKey: "AIzaSyDxfuIMFSgE0cwp9f79DvpX_r8JGK1XXVw",
            authDomain: "fabric-lagbe-a6ef7.firebaseapp.com",
            projectId: "fabric-lagbe-a6ef7",
            storageBucket: "fabric-lagbe-a6ef7.appspot.com",
            messagingSenderId: "667509701931",
            appId: "1:667509701931:web:82961afaee2d2eb051596e"
        };

        // console.log(chat_id);
        var message_buyer = [];
        var message_seller = [];
        var admin_id = 9;
        var buyerId= {{$saleRecord->buyer_user_id}};
        var sellerId= {{$saleRecord->seller_user_id}};
        var orderId =  {{$saleRecord->product_bid_id}};
        var chat_id_buyer = `buyerId_${buyerId}_orderId_${orderId}_adminId_${admin_id}`
        var chat_id_seller = `sellerId_${sellerId}_orderId_${orderId}_adminId_${admin_id}`
        // Initialize Firebase
        var app = firebase.initializeApp(firebaseConfig);
        var db = firebase.firestore(app);
        const usersRef =  db.collection("conversation").doc(chat_id_buyer)
        usersRef.get()
            .then((docSnapshot) => {
                if (docSnapshot.exists) {
                    usersRef.onSnapshot((doc) => {

                        console.log('doc have:', doc.data().messages);
                        message_buyer = doc.data().messages;
                        var lastMes = message_buyer[message_buyer.length - 1];
                        console.log(message_buyer[message_buyer.length - 1].text);
                        console.log(message_buyer);
                        message_buyer.map((mas) => {
                            if (mas.sender == admin_id) {
                                $('.msg_history_buyer').append(`<div class="outgoing_msg mt-2">
                                    <div class="sent_msg">
                                        <span class=" time_date m-0"> <img class="incoming_msg_img" src="https://ptetutorials.com/images/user-profile.png" alt="sunil" width="15px" height="15px"> ${mas.name}</span>
                                        <p>${mas.text}</p>
                                        <span class="time_date m-0">${ new Date( mas.sentTime ).toLocaleString('en-US', { hour12:true, timeZone: "Asia/Dhaka"  } )}</span> </div>
                                </div>`)
                            } else {
                                $('.msg_history_buyer').append(`<div class="incoming_msg mt-1">

                                    <div class="received_msg">
                                        <div class="received_withd_msg">
                                            <p >${mas.text}</p>
                                            <span class="time_date m-0">${ new Date( mas.sentTime ).toLocaleString('en-US', { hour12:true, timeZone: "Asia/Dhaka"  } )}</span></div>
                                    </div>
                                </div>`)
                            }
                        });


                        $(".msg_history_buyer").stop().animate({
                            scrollTop: $(".msg_history_buyer")[0].scrollHeight
                        }, 0);
                    });
                } else {
                    console.log('doc create:', );
                    usersRef.set({
                        messages: [
                            {
                                text:
                                    "Welcome to Fabric Lagbe. From now you can start chat with Admin",
                                sentTime: Date.now(),
                                sender: admin_id,
                                senderType: "admin",
                                name: "Admin",
                                position: "last",
                                createdAt: Date.now()
                            },
                            {
                                text:
                                    "How can i help you??",
                                sentTime: Date.now(),
                                sender: admin_id,
                                name: "Admin",
                                senderType: "admin",
                                position: "last",
                                createdAt: Date.now()
                            }
                        ]
                    }) // create the document
                    // location.reload();
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            });
        $('.write_msg_buyer').val("");
        $('#msg_send_btn_buyer').click(function() {
            var my_maseg = $('.write_msg_buyer').val();
            db.collection("conversation").doc(chat_id_buyer).update({
                messages: firebase.firestore.FieldValue.arrayUnion({
                    text: my_maseg,
                    sentTime: Date.now(),
                    sender: admin_id,
                    senderType: "admin",
                    name: "{{Auth::user()->name}}",
                    position: "last",
                    createdAt: Date.now()
                })
            })
                .then(() => {
                    console.log("Document successfully written!");
                })
                .catch((error) => {
                    console.error("Error writing document: ", error);
                });
             $(".msg_history_buyer").stop().animate({
                scrollTop: $(".msg_history_buyer")[0].scrollHeight
            }, 1000);
            $('.write_msg_buyer').val("");
        });
       
        $("#msg_send_btn_buyer_keypess").keypress (function(e) {
  
            if (e.which == 13) {
                var my_maseg = $('.write_msg_buyer').val();
                db.collection("conversation").doc(chat_id_buyer).update({
                    messages: firebase.firestore.FieldValue.arrayUnion({
                        text: my_maseg,
                        sentTime: Date.now(),
                        sender: admin_id,
                        name: "{{Auth::user()->name}}",
                        senderType: "admin",
                        position: "last",
                        createdAt: Date.now()
                    })
                })
                    .then(() => {
                        console.log("Document successfully written!");
                    })
                    .catch((error) => {
                        console.error("Error writing document: ", error);
                    });
                $(".msg_history_buyer").stop().animate({
                    scrollTop: $(".msg_history_buyer")[0].scrollHeight
                }, 1000);
                $('.write_msg_buyer').val("");
            }
        });

        // Initialize Firebase
        // var app2 = firebase.initializeApp(firebaseConfig);
        // var db = firebase.firestore(app2);
        const usersRefSeller =  db.collection("conversation").doc(chat_id_seller)
        usersRefSeller.get()
            .then((docSnapshot) => {
                if (docSnapshot.exists) {
                    usersRefSeller.onSnapshot((doc) => {
                        console.log('doc have:', doc.data().messages);
                        masege = doc.data().messages;
                        var lastMes = masege[masege.length - 1];
                        console.log(masege[masege.length - 1].text);
                        console.log(masege);
                        masege.map((mas) => {
                            if (mas.sender == admin_id) {
                                $('.msg_history').append(`<div class="outgoing_msg mt-2">
                                    <div class="sent_msg">
                                        <span class=" time_date m-0"> <img class="incoming_msg_img" src="https://ptetutorials.com/images/user-profile.png" alt="sunil" width="15px" height="15px"> ${mas.name}</span>
                                        <p>${mas.text}</p>
                                        <span class="time_date m-0">${ new Date( mas.sentTime ).toLocaleString('en-US', { hour12:true, timeZone: "Asia/Dhaka"  } )}</span> </div>
                                </div>`)
                            } else {
                                $('.msg_history').append(`<div class="incoming_msg mt-1">

                                    <div class="received_msg">
                                        <div class="received_withd_msg">
                                            <p >${mas.text}</p>
                                            <span class="time_date m-0">${ new Date( mas.sentTime ).toLocaleString('en-US', { hour12:true, timeZone: "Asia/Dhaka"  } )}</span></div>
                                    </div>
                                </div>`)
                            }
                        });


                        $(".msg_history").stop().animate({
                            scrollTop: $(".msg_history")[0].scrollHeight
                        }, 0);
                    });
                } else {
                    console.log('doc create:', );
                    usersRefSeller.set({
                        messages: [
                            {
                                text:
                                    "Welcome to Fabric Lagbe. From now you can start chat with Admin",
                                sentTime: Date.now(),
                                sender: admin_id,
                                senderType: "admin",
                                name: "Admin",
                                position: "last",
                                createdAt: Date.now()
                            },
                            {
                                text:
                                    "How can i help you??",
                                sentTime: Date.now(),
                                sender: admin_id,
                                name: "Admin",
                                senderType: "admin",
                                position: "last",
                                createdAt: Date.now()
                            }
                        ]
                    }) // create the document
                    // location.reload();
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            });
        $('.write_msg').val("");
        $('#msg_send_btn').click(function() {
            var my_maseg = $('.write_msg').val();
            db.collection("conversation").doc(chat_id_seller).update({
                messages: firebase.firestore.FieldValue.arrayUnion({
                    text: my_maseg,
                    sentTime: Date.now(),
                    sender: admin_id,
                    senderType: "admin",
                    name: "{{Auth::user()->name}}",
                    position: "last",
                    createdAt: Date.now()
                })
            })
                .then(() => {
                    console.log("Document successfully written!");
                })
                .catch((error) => {
                    console.error("Error writing document: ", error);
                });
           
            $(".msg_history").stop().animate({
                scrollTop: $(".msg_history")[0].scrollHeight
            }, 1000);
            $('.write_msg').val("");
        });
        $("#msg_send_btn_keypress").keypress(function(e) {
          if (e.which == 13) {
                var my_maseg = $('.write_msg').val();
                db.collection("conversation").doc(chat_id_seller).update({
                    messages: firebase.firestore.FieldValue.arrayUnion({
                        text: my_maseg,
                        sentTime: Date.now(),
                        sender: admin_id,
                        name: "{{Auth::user()->name}}",
                        senderType: "admin",
                        position: "last",
                        createdAt: Date.now()
                    })
                })
                    .then(() => {
                        console.log("Document successfully written!");
                    })
                    .catch((error) => {
                        console.error("Error writing document: ", error);
                    });
                $(".msg_history").stop().animate({
                    scrollTop: $(".msg_history")[0].scrollHeight
                }, 1000);
                $('.write_msg').val("");
            }
        });
    </script>
@endpush
