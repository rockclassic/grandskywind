<div class="row" id="content-wrapper">
    <div class="col-xs-12">
        <? $this->load->view('crm/common/top'); ?>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='box bordered-box muted-border' style='margin-bottom:0;'>
                    <div class='box-header muted-background' style="height:30px;padding: 0px">
                        <div class='title'><?=$this->session->userdata('title')?> </div>
                    </div>
                    <div class='box-content' style="border-bottom: 0;">
                        <main>
                            <p>Welcome to the push messaging codelab. The button below needs to be
                                fixed to support subscribing to push.</p>
                            <p>
                                <button  class="js-push-btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                                   메세지 사용하기
                                </button>
                            </p>
                            <section class="subscription-details js-subscription-details is-invisible">
                                <p>Once you've subscribed your user, you'd send their subscription to your
                                    server to store in a database so that when you want to send a message
                                    you can lookup the subscription and send a message to it.</p>
                                <p>To simplify things for this code lab copy the following details
                                    into the <a href="https://web-push-codelab.glitch.me//">Push Companion
                                        Site</a> and it'll send a push message for you, using the application
                                    server keys on the site - so make sure they match.</p>
                                <pre><code class="js-subscription-json"></code></pre>
                            </section>
                        </main>
                    </div>
                </div>
            </div>
            <script src="/assets/javascripts/main.js"></script>
            <script src="https://code.getmdl.io/1.2.1/material.min.js"></script>
            <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

            <!--           <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">-->
            <!--           <link rel="stylesheet" href="/assets/stylesheets/index.css">-->

<style>
            p {
            font-size: 14px;
            letter-spacing: 0;
            margin: 0 0 16px;
            }

            h6, p {
                font-weight: 400;
                line-height: 24px;
            }
            h1, h2, h3, h4, h5, h6, p {
                padding: 0;
            }
</style>