<html lang="en" data-theme="dark">
   <head>
      <meta charset="utf-8">
      <link rel="icon" href="/favicon.ico">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <meta name="description" content="Modzy is the secure ModelOps and MLOps platform for businesses to deploy, manage, and get value from AI at scale.">
      <meta name="theme-color" content="#ffffff">
      <link rel="apple-touch-icon" href="/logo192.png">
      <link rel="manifest" href="/manifest.json">
      <title>Sign in to Modzy | Modzy</title>
      <link href="/css/page/app/index.css" rel="stylesheet">
   </head>
   <body>
      <div id="root">
         <main class="modzy-auth-page login-page flex-centered">
            <div data-box="true" class="content" style="width: 420px;">
               <div data-box="true" class="p-xl bg-1 radius-lg shadow-xxl">
                  <div data-box="true" class="display-flex flex-direction-column align-items-center">
                     <svg viewBox="0 0 24 24" width="42" height="42" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 0v15.213a8.808 8.808 0 01-8.515 8.782l-.279.005H0V8.798A8.808 8.808 0 018.52.005L8.794 0H24zm-5.554 5.545H8.828a3.252 3.252 0 00-3.246 3.062l-.005.191v9.668h9.629a3.252 3.252 0 003.234-3.062l.006-.19V5.544z" fill="currentColor"></path>
                        <path d="M14.998 14.156V9h-5.2A.793.793 0 009 9.789V15h5.2c.222 0 .434-.09.585-.25a.784.784 0 00.213-.594z" fill="#86E4DB"></path>
                     </svg>
                     <div data-spacer="true" class="md"></div>
                     <h1 data-heading="true" class="title-lg">Sign in to Modzy</h1>
                     <small style="text-align: center;margin-top: 8px;opacity: 0.7;"> This is a mockup UI from modzy.com for demonstration purposes </small>
                  </div>
                  <div data-spacer="true" class="lg"></div>
                  {{Form::open(['method'=>'post', 'url' => route('login.submit')])}}
                     <div data-text-field="true" class="field-outer-container size-md">
                        <div class="field-label-wrapper"><label data-label="true" id="email-label" class="text-md font-sans text-500 label-required" for="email">Email<span data-label-required-dot="true" aria-hidden="true"></span></label></div>
                        <div class="field-inner-container">
                           <div class="field-input-wrapper"><input class="sarsa-text-field-input size-md text-md" type="text" id="email" name="email" required="" aria-invalid="false" aria-describedby="" value="demo@gmail.com"></div>
                           <div data-input-error="true" id="email-error" class="text-sm-tight text-600 text-color-critical pt-xxs" aria-live="assertive"></div>
                        </div>
                     </div>
                     <div data-spacer="true" class="md"></div>
                     <div>
                        <div data-text-field="true" data-password-field="true" class="field-outer-container size-md">
                           <div class="field-label-wrapper"><label data-label="true" id="password-label" class="text-md font-sans text-500 label-required" for="password">Password<span data-label-required-dot="true" aria-hidden="true"></span></label></div>
                           <div class="field-inner-container">
                              <div class="field-input-wrapper">
                                 <input class="sarsa-text-field-input size-md text-md" type="password" id="password" name="password" required="" aria-invalid="false" aria-describedby="" value="demo">
                                 <span class="text-field-button-wrapper flex-centered">
                                    <button data-button="true" data-icon-button="true" type="button" class="text-500 radius-md size-xs subtle" aria-label="Show password">
                                       <span aria-hidden="true" class="flex-centered button-icon">
                                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20">
                                             <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd"></path>
                                             <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"></path>
                                          </svg>
                                       </span>
                                    </button>
                                 </span>
                              </div>
                              <div data-input-error="true" id="password-error" class="text-sm-tight text-600 text-color-critical pt-xxs" aria-live="assertive"></div>
                           </div>
                        </div>
                        <div data-text="true" class="font-sans text-sm color-text-1 text-500 word-break text-align-left"><a class="link" href="/reset-password">Forgot password?</a></div>
                     </div>
                     <div data-spacer="true" class="lg"></div>
                     <button data-button="true" type="submit" class="text-500 color-text-1 inline-flex-centered size-md text-md px-sm primary fit-container radius-md"><span class="inner-wrap display-flex flex-centered">Sign In</span></button>
                    {{ Form::close()}}
               </div>
               <div data-spacer="true" class="md"></div>
               <div data-box="true" class="px-md py-sm radius-lg content-bonus create-account-box">
                  <div data-text="true" class="font-sans text-md color-text-white text-500 word-break text-align-center">New to Modzy? <a href="https://modzy.com/sign-up">Create an account</a></div>
               </div>
            </div>
         </main>
      </div>
      <div id="modzy-toast-container" class="">
         <div data-toaster="true"></div>
      </div>
   </body>
</html>