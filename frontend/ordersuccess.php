<?php
	require 'php/frontendheader.php';

?>
<div class="jumbotron jumbotron-fluid subtitle">
	<div class="container">
		<h1 class="text-center text-white"> Order Received </h1>
	</div>
</div>

   <style media="screen">
     
     .alert {
       background: #f8d7da;
       padding: 5px 10px;
       border-radius: 8px;
     }
       .animation-ctn{
           text-align:center;
           margin: 5em auto;
       }

       @-webkit-keyframes checkmark {
       0% {
           stroke-dashoffset: 100px
       }

       100% {
           stroke-dashoffset: 200px
       }
       }

       @-ms-keyframes checkmark {
       0% {
           stroke-dashoffset: 100px
       }

       100% {
           stroke-dashoffset: 200px
       }
       }

       @keyframes checkmark {
       0% {
           stroke-dashoffset: 100px
       }

       100% {
           stroke-dashoffset: 0px
       }
       }

       @-webkit-keyframes checkmark-circle {
       0% {
           stroke-dashoffset: 480px

       }

       100% {
           stroke-dashoffset: 960px;

       }
       }

       @-ms-keyframes checkmark-circle {
       0% {
           stroke-dashoffset: 240px
       }

       100% {
           stroke-dashoffset: 480px
       }
       }

       @keyframes checkmark-circle {
       0% {
           stroke-dashoffset: 480px
       }

       100% {
           stroke-dashoffset: 960px
       }
       }

       @keyframes colored-circle {
       0% {
           opacity:0
       }

       100% {
           opacity:100
       }
       }

       /* other styles */
       /* .svg svg {
       display: none
       }
       */
       .inlinesvg .svg svg {
       display: inline
       }

       /* .svg img {
       display: none
       } */

       .icon--order-success svg polyline {
       -webkit-animation: checkmark 0.3s ease-in-out 0.9s backwards;
       animation: checkmark 0.3s ease-in-out 0.9s backwards
       }

       .icon--order-success svg circle {
       -webkit-animation: checkmark-circle 0.6s ease-in-out backwards;
       animation: checkmark-circle 0.6s ease-in-out backwards;
       }
       .icon--order-success svg circle#colored {
       -webkit-animation: colored-circle 0.6s ease-in-out 0.7s backwards;
       animation: colored-circle 0.6s ease-in-out 0.7s backwards;
       }
   </style>

   <div class="animation-ctn">
         <div class="icon icon--order-success svg">
           <svg xmlns="http://www.w3.org/2000/svg" width="154px" height="154px">
               <g fill="none" stroke="#f5587b" stroke-width="2">
                 <circle cx="77" cy="77" r="72" style="stroke-dasharray:480px, 480px; stroke-dashoffset: 960px;"></circle>
                 <circle id="colored" fill="#f5587b" cx="77" cy="77" r="72" style="stroke-dasharray:480px, 480px; stroke-dashoffset: 960px;"></circle>
                 <polyline class="st0" stroke="#fff" stroke-width="10" points="43.5,77.8 63.7,97.9 112.2,49.4 " style="stroke-dasharray:100px, 100px; stroke-dashoffset: 200px;"/>
               </g>
           </svg>
       </div>
       <br />
       <h2>Order Success</h2>
     <p>Your order is on its way!</p>
     <!-- <p> Txn Amount: 15,000</p>
     <span class="alert">कृपया पछाडि जानको लागि <b>Back Button</b>  दाब्नुहोस्।</span> -->
   </div>

<?php
require 'php/frontendfooter.php';
?>