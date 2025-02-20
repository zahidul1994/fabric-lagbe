@extends('frontend.layouts.master')
@section("title","Chat with admin")
@push('css')

    <link rel="stylesheet" href="{{asset('backend/vendor_chat.css')}}">
    <style>
        ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
            color: #000000;
            font-weight: bold;
            margin-left: 10px;
            font-size: 16px;
        }
        ::-moz-placeholder { /* Firefox 19+ */
            color: #246bd3;
            margin-left: 10px;
        }
        :-ms-input-placeholder { /* IE 10+ */
            color: #246bd3;
            margin-left: 10px;

        }
        :-moz-placeholder { /* Firefox 18- */
            color: #246bd3;
            margin-left: 10px;
        }
        .m_t_30{
            margin-top: -30px;
        }
    </style>
@endpush
@section('content')
    <!-- Main content -->

    <div class="full-row m_t_30">
        <div class="container">
            <div class="row">
                @include('frontend.buyer.buyer_breadcrumb')
                @include('frontend.buyer.buyer_sidebar')
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h3 class="card-title float-left">@lang('website.Chat with admin') <span style="font-size: 16px">({{$saleRecord->product->name}}) <img src="{{url($saleRecord->product->thumbnail_img)}}" width="50" height="50"></span></h3>
                                </div>
                                <div class="messaging">
                                    <div class="inbox_msg">
                                        <div class="mesgs">
                                            <div class="msg_history" style="height: 400px">
                                            </div>
                                            <div class="type_msg" style="position: sticky">
                                                <div class="input_msg_write">
                                                    <input type="text" class="write_msg" placeholder="Type a message" name="chat_message" required/>
                                                    <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@push('js')
{{--    The core Firebase JS SDK is always required and must be listed first -->--}}
    <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-app.js"></script>
{{--    TODO: Add SDKs for Firebase products that you want to use--}}
{{--     https://firebase.google.com/docs/web/setup#available-libraries -->--}}
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

          {{--var firebaseConfig = {{ json_decode(file_get_contents('firebase-credentials.json'), true)}};--}}

        // console.log(chat_id);
        var masege = [];
        var buyerId= {{Auth::id()}};
        var orderId =  {{$saleRecord->product_bid_id}};
        var chat_id = `buyerId_${buyerId}_orderId_${orderId}_adminId_9`
        //var admin_id = 9;
        // Initialize Firebase
        var app = firebase.initializeApp(firebaseConfig);
        db = firebase.firestore(app);
        const usersRef =  db.collection("conversation").doc(chat_id)
        usersRef.get()
            .then((docSnapshot) => {
                if (docSnapshot.exists) {
                    usersRef.onSnapshot((doc) => {

                        console.log('doc have:', doc.data().messages);
                        masege = doc.data().messages;
                        var lastMes = masege[masege.length - 1];
                        console.log(masege[masege.length - 1].text);
                        console.log(masege);
                        masege.map((mas) => {
                            if (mas.sender == buyerId) {
                                $('.msg_history').append(`<div class="outgoing_msg mt-2">
                                    <div class="sent_msg">

                                        <p>${mas.text}</p>
                                        <span class="time_date m-0">${ new Date( mas.sentTime ).toLocaleString('en-US', { hour12:true, timeZone: "Asia/Dhaka"  } )}</span> </div>
                                </div>`)
                            } else {
                                $('.msg_history').append(`<div class="incoming_msg mt-1">

                                    <div class="received_msg">
                                        <div class="received_withd_msg">
                                            <span class=" time_date m-0"> <img class="incoming_msg_img" src="https://ptetutorials.com/images/user-profile.png" alt="sunil">Admin</span>
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
                    usersRef.set({
                        messages: [
                            {
                                text:
                                    "Hello admin. How are you?",
                                sentTime: Date.now(),
                                sender: buyerId,
                                name: "{{Auth::user()->name}}",
                                senderType: "buyer",
                                position: "last",
                                createdAt: Date.now()
                            },
                            {
                                text:
                                    "I want to talk with you.",
                                sentTime: Date.now(),
                                sender: buyerId,
                                name: "{{Auth::user()->name}}",
                                senderType: "buyer",
                                position: "last",
                                createdAt: Date.now()
                            }
                        ]
                    }) // create the document
                    // location.reload();
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                }
            });
        $('.write_msg').val("");
        $('.msg_send_btn').click(function() {
            var my_maseg = $('.write_msg').val();
            db.collection("conversation").doc(chat_id).update({
                messages: firebase.firestore.FieldValue.arrayUnion({
                    text: my_maseg,
                    sentTime: Date.now(),
                    sender: buyerId,
                    name: "{{Auth::user()->name}}",
                    senderType: "buyer",
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
            // $('.msg_history').append(`<div class="outgoing_msg mt-2">
            //                         <div class="sent_msg">
            //                             <p>${my_maseg}</p>
            //                             <span class="time_date m-0"> 11:01 AM    |    June 9</span> </div>
            //                     </div>`)
            $(".msg_history").stop().animate({
                scrollTop: $(".msg_history")[0].scrollHeight
            }, 1000);
            $('.write_msg').val("");
        });
        $(document).on('keypress', function(e) {
            if (e.which == 13) {
                var my_maseg = $('.write_msg').val();
                db.collection("conversation").doc(chat_id).update({
                    messages: firebase.firestore.FieldValue.arrayUnion({
                        text: my_maseg,
                        sentTime: Date.now(),
                        sender: buyerId,
                        name: "{{Auth::user()->name}}",
                        senderType: "buyer",
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
