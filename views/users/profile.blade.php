@extends('platform::layout')

@section('page-heading')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Lista użytkowników</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a>Administracja</a>
                </li>
                <li class="active">
                    <strong>Użytkownicy</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection

@section('content')
    <div class="wrapper wrapper-content">


        <div class="row m-b-lg m-t-lg">
            <div class="col-md-6">

                <div class="profile-image">
                    {!! \ViewHelper::userAvatar($user, 'huge', 'inline border') !!}
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2 class="no-margins">
                                {!! $user->getFirstAndLastName() !!}
                            </h2>
                            <h4>{!! $user->job_title !!}</h4>
                            <small>
                                Lista ról
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <table class="table small m-b-xs">
                    <tbody>
                    <tr>
                        <td>
                            <strong>142</strong> Projects
                        </td>
                        <td>
                            <strong>22</strong> Followers
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <strong>61</strong> Comments
                        </td>
                        <td>
                            <strong>54</strong> Articles
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>154</strong> Tags
                        </td>
                        <td>
                            <strong>32</strong> Friends
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <small>Sales in last 24h</small>
                <h2 class="no-margins">206 480</h2>
                <div id="sparkline1"><canvas width="347" height="50" style="display: inline-block; width: 347px; height: 50px; vertical-align: top;"></canvas></div>
            </div>


        </div>
        <div class="row">

            <div class="col-lg-6">

                <div class="ibox">
                    <div class="ibox-content">
                        <h3>About Alex Smith</h3>

                        <p class="small">
                            There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form, by injected humour, or randomised words which don't.
                            <br>
                            <br>
                            If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't
                            anything embarrassing
                        </p>

                        <p class="small font-bold">
                            <span><i class="fa fa-circle text-navy"></i> Online status</span>
                        </p>

                    </div>
                </div>

                <div class="ibox">
                    <div class="ibox-content">
                        <h3>Followers and friends</h3>
                        <p class="small">
                            If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't
                            anything embarrassing
                        </p>
                        <div class="user-friends">
                        </div>
                    </div>
                </div>

                <div class="ibox">
                    <div class="ibox-content">
                        <h3>Personal friends</h3>
                        <ul class="list-unstyled file-list">
                            <li><a href=""><i class="fa fa-file"></i> Project_document.docx</a></li>
                            <li><a href=""><i class="fa fa-file-picture-o"></i> Logo_zender_company.jpg</a></li>
                            <li><a href=""><i class="fa fa-stack-exchange"></i> Email_from_Alex.mln</a></li>
                            <li><a href=""><i class="fa fa-file"></i> Contract_20_11_2014.docx</a></li>
                            <li><a href=""><i class="fa fa-file-powerpoint-o"></i> Presentation.pptx</a></li>
                            <li><a href=""><i class="fa fa-file"></i> 10_08_2015.docx</a></li>
                        </ul>
                    </div>
                </div>

                <div class="ibox">
                    <div class="ibox-content">
                        <h3>Private message</h3>

                        <p class="small">
                            Send private message to Alex Smith
                        </p>

                        <div class="form-group">
                            <label>Subject</label>
                            <input type="email" class="form-control" placeholder="Message subject">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" placeholder="Your message" rows="3"></textarea>
                        </div>
                        <button class="btn btn-primary btn-block">Send</button>

                    </div>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <button class="btn btn-xs btn-primary pull-right" type="submit"><i class="fa fa-save"></i> Aktualizuj</button>
                        <h4>Ustawienia</h4>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal ajax" role="form" method="post" action="{{action('\Code4\Platform\Controllers\UsersController@saveProfile', $user->id)}}">

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Używać gravatarów</label>
                                <div class="col-lg-9">{!! $form->get('useGravatar')->checked($user->getSetting('useGravatar')) !!}</div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Kolor użytkownika</label>
                                <div class="col-lg-9">{!! $form->get('userColor')->groupChecked($user->getSetting('userColor', 'color-2')) !!}</div>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-save"></i> Aktualizuj</button>
                            </div>
                            <div class="row"></div>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('scripts')

@endsection
