

<div class="container navbar-container">
    <div class="panel panel-white right">
        <div class="overlay"></div>
        <ul class="list-unstyled navbar-items">
            <li class="menu-label">Menu</li>
            <li class="active">
                <a href="{{route('campaigns.list')}}">
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    Campaigns
                </a>
            </li>
            <li class="active">
                <a href="{{route('coupons.list')}}">
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    My Coupons
                </a>
            </li>
            <li>
                <a href="{{route('receipts.list')}}">
                    <i class="fa fa-ticket" aria-hidden="true"></i>
                    My Receipts
                </a>
            </li>
            <li>
                <a href="{{route('account.profile')}}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    My Profile
                </a>
            </li>
            <li>
                <a href="{{route('pages.faq')}}">
                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                    FAQ
                </a>
            </li>
            <li>
                <a href="{{route('auth.logout')}}">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    Sign out
                </a>
            </li>
            <li class="menu-label">Get in touch</li>
            <li class="html-block">
                <div class="social-icons size-normal fx fx-cl-items">
                    <a
                            href="https://www.facebook.com/supercentrebelrose"
                            target="_blank"
                            rel="nofollow"
                            class="icon icon-facebook-link fx fx-cc-items"
                    >
                        <span class="social-icon icon-facebook"></span>
                    </a>
                    <a
                            href="https://www.instagram.com/supercentres"
                            target="_blank"
                            rel="nofollow"
                            class="icon icon-instagram-link fx fx-cc-items"
                    >
                        <span class="social-icon icon-instagram"></span>
                    </a>
                </div>
            </li>
            {{--<li class="menu-contacts"><a>p: 0123 456 789</a></li>--}}
            {{--<li class="menu-contacts"><a>a: 11/222 Mason Street,<br> Newport, VIC 3015</a></li>--}}
        </ul>
    </div>
    <a class="ninja-btn right" title="menu"><span></span></a>
    <!-- panel -->

    <div class="panel-overlay"></div>
</div>
