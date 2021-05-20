@extends('layouts.app')
@section('title', 'Livescore')
@section('content')

    <div class="container">
        @foreach($fixtures as $fixture)
            <div class="card">
                <div class="card-body">
                    <div class="card-title flex-row align-items-center justify-content-between">
                        <img src="{{$fixture['flag']}}" alt="flag" class="nation-image">
                        <p class="nation-p">{{$fixture['nation']}}</p>
                    </div>
                    @foreach($fixture['leagues'] as $key => $nation_leagues)

                        <div class="card-title flex-row align-items-center justify-content-center">
                            <img src="{{isset($nation_leagues['logo']) ? $nation_leagues['logo'] : ""}}" alt="flag"
                                 class="nation-image">
                            {{$key}}
                        </div>
                        @foreach($nation_leagues['matches'] as $league)
                            <ul class="list-group">
                                <li class="list-group-item mt-2">
                                    <div class="fixture d-flex flex-row  justify-content-between">
                                        <div class="col-2 elapsed">
{{--                                            <img src="{{asset(url('img/timer-483.png'))}}" />--}}
                                            <p>{{$league['fixture']->status->elapsed}}</p>
                                        </div>
                                        <div
                                            class="col-5 fixture-team fixture-home d-flex justify-content-between  flex-row">
                                            <p class="team-name-home">{{$league['teams']->home->name}}</p>
                                            <img src="{{$league['teams']->home->logo}}" alt="home-team-logo"
                                                 class="team-logo">
                                            <p class="team-goals">{{$league['goals']->home}}</p>
                                        </div>
                                        <p>-</p>
                                        <div
                                            class="col-5 fixture-team fixture-away d-flex justify-content-between flex-row-reverse">
                                            <p class="team-name-away">{{$league['teams']->away->name}}</p>
                                            <img src="{{$league['teams']->away->logo}}" alt="home-team-logo"
                                                 class="team-logo">
                                            <p class="team-goals">{{$league['goals']->away}}</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-column mb-5 mt-4 faq-section">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="accordion-{{$league['fixture']->id}}">
                                                    <div class="card">
                                                        <div class="card-header" id="heading-1">
                                                            <h5 class="mb-0">
                                                                <a role="button" data-toggle="collapse"
                                                                   href="#collapse-{{$league['fixture']->id}}"
                                                                   aria-expanded="false"
                                                                   aria-controls="collapse-{{$league['fixture']->id}}">
                                                                    Match Events
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="collapse-{{$league['fixture']->id}}"
                                                             class="collapse"
                                                             data-parent="#accordion-{{$league['fixture']->id}}"
                                                             aria-labelledby="heading-1">
                                                            <div class="card-body d-flex flex-column">
                                                                @foreach($league['events'] as $event)
{{--                                                                    {{var_dump($event)}}--}}
                                                                    @if($event->team->name === $league['teams']->home->name )
                                                                        <div class="row row-left">
                                                                            <div
                                                                                class="event home-event d-flex flex-row justify-content-between">
                                                                                @if($event->type==='Goal' &&$event->detail==='Normal Goal')
                                                                                    <img class="home-goal"
                                                                                         src="{{asset(url('img/ball-444.png'))}}">
                                                                                    <div
                                                                                        class="row d-flex flex-row justify-content-around">
                                                                                        <p>{{$event->time->elapsed}}</p>
                                                                                        <p>{{$event->player->name}}</p>
                                                                                        <p>{{isset($event->assist->name) && $event->assist->name!==null ? " (".$event->assist->name.")" : null }}</p>
                                                                                    </div>
                                                                                @elseif($event->type==='Goal' &&$event->detail==='Own Goal')
                                                                                    <img class="home-own-goal"
                                                                                         src="{{asset(url('img/ball-445.png'))}}">
                                                                                    <div
                                                                                        class="row d-flex flex-row justify-content-around">
                                                                                        <p>{{$event->time->elapsed}}</p>
                                                                                        <p>{{$event->player->name}}</p>
                                                                                        <p> {{("Own Goal")}}</p>
                                                                                    </div>
                                                                                @elseif($event->type==='Goal' &&$event->detail==='Missed Penalty')
                                                                                    <img class="home-missed-penalty"
                                                                                         src="{{asset(url('img/penalty-miss-459.png'))}}">
                                                                                    <div
                                                                                        class="row d-flex flex-row justify-content-around">
                                                                                        <p>{{$event->time->elapsed}}</p>
                                                                                        <p>{{$event->player->name}}</p>
                                                                                    </div>
                                                                                @elseif($event->type==='Card' && $event->detail==='Yellow Card')
                                                                                    <img class="home-yellow"
                                                                                         src="{{asset(url('img/yellow-card-489.png'))}}"
                                                                                    >
                                                                                    <div
                                                                                        class="row d-flex flex-row justify-content-around">
                                                                                        <p>{{$event->time->elapsed}}</p>
                                                                                        <p>{{$event->player->name}}</p>
                                                                                    </div>
                                                                                @elseif($event->type==='Card' && $event->detail==='Red Card')
                                                                                    <img class="home-red"
                                                                                         src="{{asset(url('img/red-card-460.png'))}}">
                                                                                    <div
                                                                                        class="row d-flex flex-row justify-content-around">
                                                                                        <p>{{$event->time->elapsed}}</p>
                                                                                        <p>{{$event->player->name}}</p>
                                                                                    </div>
                                                                                @elseif($event->type==='subst')
                                                                                    <img class="home-sub"
                                                                                         src="{{asset(url('img/substitution--473.png'))}}">
                                                                                    <div
                                                                                        class="row d-flex flex-row justify-content-around">
                                                                                        <p>{{$event->time->elapsed}}</p>
                                                                                        <p>{{$event->player->name}}</p>
                                                                                        <p>{{$event->assist->name}}</p>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    @endif


                                                                    @if($event->team->name === $league['teams']->away->name )
                                                                        <div class="row row-right flex-row-reverse">
                                                                            <div
                                                                                class="event away-event d-flex flex-row-reverse justify-content-between">
                                                                                @if($event->type==='Goal' && $event->detail==='Normal Goal')
                                                                                    <img class="away-goal"
                                                                                         src="{{asset(url('img/ball-444.png'))}}"
                                                                                    >
                                                                                    <div
                                                                                        class="row d-flex flex-row-reverse justify-content-between">
                                                                                        <p>{{$event->time->elapsed}}</p>
                                                                                        <p>{{$event->player->name}}</p>
                                                                                        <p>{{isset($event->assist->name) && $event->assist->name!==null ? " (".$event->assist->name.")" : null }}</p>
                                                                                    </div>
                                                                                @elseif($event->type==='Goal' &&$event->detail==='Own Goal')
                                                                                    <img class="away-own-goal"
                                                                                         src="{{asset(url('img/ball-445.png'))}}">
                                                                                    <div
                                                                                        class="row d-flex flex-row-reverse justify-content-around">
                                                                                        <p>{{$event->time->elapsed}}</p>
                                                                                        <p>{{$event->player->name}}</p>
                                                                                        <p> {{("Own Goal")}}</p>
                                                                                    </div>
                                                                                @elseif($event->type==='Goal' &&$event->detail==='Missed Penalty')
                                                                                    <img class="away-missed-penalty"
                                                                                         src="{{asset(url('img/penalty-miss-459.png'))}}">
                                                                                    <div
                                                                                        class="row d-flex flex-row-reverse justify-content-around">
                                                                                        <p>{{$event->time->elapsed}}</p>
                                                                                        <p>{{$event->player->name}}</p>

                                                                                    </div>
                                                                                @elseif($event->type==='Card' && $event->detail==='Yellow Card')
                                                                                    <img class="away-yellow"
                                                                                         src="{{asset(url('img/yellow-card-489.png'))}}">
                                                                                    <div
                                                                                        class="row d-flex flex-row-reverse justify-content-between">
                                                                                        <p>{{$event->time->elapsed}}</p>
                                                                                        <p>{{$event->player->name}}</p>
                                                                                    </div>
                                                                                @elseif($event->type==='Card' && $event->detail==='Red Card')
                                                                                    <img class="away-red"
                                                                                         src="{{asset(url('img/red-card-460.png'))}}">
                                                                                    <div
                                                                                        class="row d-flex flex-row-reverse justify-content-between">
                                                                                        <p>{{$event->time->elapsed}}</p>
                                                                                        <p>{{$event->player->name}}</p>
                                                                                    </div>
                                                                                @elseif($event->type==='subst')
                                                                                    <img class="away-sub"
                                                                                         src="{{asset(url('img/substitution--473.png'))}}">
                                                                                    <div
                                                                                        class="row d-flex flex-row-reverse justify-content-around">
                                                                                        <p>{{$event->time->elapsed}}</p>
                                                                                        <p>{{$event->player->name}}</p>
                                                                                        <p>{{$event->assist->name}}</p>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    @endforeach
                </div>
            </div>
        @endforeach

    </div>
@endsection


