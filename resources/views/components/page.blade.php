<?php
    $title = (strlen($title) > 0) ? $title : 'Untitled Page';
    $kicker = (strlen($kicker) > 0) ? $kicker : null;
?>
<!DOCTYPE html>
<html>
    <head>
        @component('components.meta', ['title' => $title])
        @endcomponent
    </head>
    <body class="is-bootstrap" style="overflow-x: hidden">
        <!-- Login Modal -->
        <div class="modal fade" id="loginmodal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div>
                        <img onclick="closeModal()" class="float-end" src="/public/assets/images/home/modal-x.svg" alt="">
                    </div>
                    <h2 class="text-center">Welcome, Guest</h2>
                    <div class="container d-flex d-flex flex-column justify-content-center align-items-center">
                        <input class="text" id="email" type="email" name="email" placeholder="E-Mail">
                        <input class="text" id="password" type="password" name="password" placeholder="Password">
                        <div class="align-self-start">
                            <input class="checkbox" id="rememberme" type="checkbox" name="rememberme">
                            &nbsp; Remember me
                        </div>
                        <button type="submit">Login</button>
                        <span>
                            <a href="">Forgot Your Password?</a>
                            <a href="">Create Account</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($children))
            @foreach($children as $widget)
                @component('functions.parse-widget', ['widget' => $widget])
                @endcomponent
            @endforeach
        @endif
        <div class="container-0 pb-0">
            @if(isset($related) && is_array($related) && count($related) > 0)
                @component('components.section-heading', ['title' => 'Related Articles', 'show_down_arrow' => true])
                @endcomponent
                <div class="row margin-1 justify-content-center">
                    @foreach($related as $r)
                        <?php
                            $r_content = App\Http\Controllers\PagesController::parseYamlFromPage($r);
                        ?>
                        @if($r_content !== false && isset($r_content['@manifest']))
                            <div class="col-12 col-sm-6 col-md-4">
                                <a class="card my-3 discreet" href="{{ $r_content['canonical_url'] ?? ('/info/' . $r) }}">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">{{ $r_content['title'] }}</h5>
                                        <p>{{ App\Http\Controllers\PagesController::getExcerptFromWidget($r_content, true, 250) }}</p>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
            @component('components.sponsors')
            @endcomponent
            <img class="container-clip for-footer" src="/img/backgrounds/7.png">
            @component('components.imagecompat', ['src' => '/img/accessories/2021/wave-end-1.svg', 'class' => 'w-100 p-0 mt-5 mb-0'])
            @endcomponent
        </div>
        @component('components.footer')
        @endcomponent
    </body>
</html>
