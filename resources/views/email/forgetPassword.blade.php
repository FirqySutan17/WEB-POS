@extends('admin.authentication.master')


@section('content')
{{-- start preheader --}}
<div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
   noreplay this message. We just got request to reset password this your token: {{$token}} 
 </div>
 <!-- end preheader -->

 <!-- start body -->
 <table border="0" cellpadding="0" cellspacing="0" width="100%">
   <!-- start logo -->
   <tr>
     <td align="center" bgcolor="#e9ecef">
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
         <tr>
           <td align="center" valign="top" style="padding: 36px 24px;">
             <a href="https://www.brandztory.com/id" target="_blank" style="display: inline-block;">
               <img src="https://www.brandztory.com/image/seo/brandztory-jasa-digital-marketing-creative-agency-jakarta.png" alt="Logo" border="0" width="250"  style="display: block; min-width: 48px;">
             </a>
           </td>
         </tr>
       </table>
     </td>
   </tr>
   <!-- end logo -->

   <!-- start hero -->
   <tr>
     <td align="center" bgcolor="#e9ecef">
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
         <tr>
           <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
             <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">Reset Your Password</h1>
           </td>
         </tr>
       </table>
     </td>
   </tr>
   <!-- end hero -->

   <!-- start copy block -->
   <tr>
     <td align="center" bgcolor="#e9ecef">
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

         <!-- start copy -->
         <tr>
           <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
             <p style="margin: 0;">We received a request to reset your personal password.
               Click the button in this section bellow to get your new password.</p>
           </td>
         </tr>
         <!-- end copy -->

         <!-- start button -->
         <tr>
           <td align="left" bgcolor="#ffffff">
             <table border="0" cellpadding="0" cellspacing="0" width="100%">
               <tr>
                 <td align="center" bgcolor="#ffffff" style="padding: 12px;">
                   <table border="0" cellpadding="0" cellspacing="0">
                     <tr>
                       <td align="center" bgcolor="#f52738" style="border-radius: 6px;">
                         <a href="{{ route('reset.password.get', $token) }}" target="_blank" style="display: inline-block; padding: 16px 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;">Reset Now</a>
                       </td>
                     </tr>
                   </table>
                 </td>
               </tr>
             </table>
           </td>
         </tr>
         <!-- end button -->

         <!-- start copy -->
         <tr>
           <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
             <p style="margin: 0;">If you not request to reset password you might be to call us quickly to secure your account</p>
             <p style="margin: 0;">This our phone number: 08 11 88 11 598</p>
           </td>
         </tr>
         <!-- end copy -->
         <!-- start copy -->
         <tr>
           <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf">
             <p style="margin: 0;">Regrads,<br> Brandztory</p>
           </td>
         </tr>
         <!-- end copy -->
       </table>
     </td>
   </tr>
   <!-- end copy block -->
   <!-- start footer -->
   <tr>
     <td align="center" bgcolor="#e9ecef" style="padding: 24px;">
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
         <!-- start unsubscribe -->
         <tr>
           <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
             <p style="margin: 0;">You can visit our web to get more information <a href="https://www.brandztory.com/id" target="_blank">visit brandztory</a></p>
             <p style="margin: 0;">Wisma 77 Tower 2 (Lantai 16) Jl. Letjen S. Parman No.77 Jakarta Barat - 11410</p>
           </td>
         </tr>
         <!-- end unsubscribe -->
       </table>
     </td>
   </tr>
   <!-- end footer -->
 </table>
 <!-- end body -->
@endsection
