<div class="card m-t--50">
    <div class="card-body">
        <center> <img src="{{ getUsersAvatar($contact->avatar_directory, $contact->avatar_filename) }}"
                class="img-circle" width="120">
            <h4 class="card-title m-t-10">{{ $contact->first_name }} {{ $contact->last_name }}</h4>
            <h6 class="card-subtitle">{{ $contact->email }}</h6>
            <span class="label {{ runtimeUserTypeLabel($contact->type) }}">
                @if($contact->type == 'team')
                @lang('lang.team_member')
                @endif
                @if($contact->type == 'client')
                @lang('lang.client_user')
                @endif
                @if($contact->type == 'contact')
                @lang('lang.email_contact')
                @endif
            </span>
        </center>
    </div>
    <div>
        <hr>
    </div>
    <div class="card-body p-t-0">
        <small class="text-muted p-t-10 db">@lang('lang.telephone')</small>
        <h6>{{ $contact->telephone ?? '---' }}</h6>
        <small class="text-muted p-t-30 db">@lang('lang.job_title')</small>
        <h6>{{ $contact->position ?? '---' }}</h6>
        <small class="text-muted p-t-30 db">@lang('lang.date_added')</small>
        <h6>{{ runtimeDate($contact->created) }}</h6>
        <small class="text-muted p-t-30 db">@lang('lang.last_seen')</small>
        <h6>{{ runtimeDateAgo($contact->last_seen) }}</h6>
        <br>
        @if($contact->social_twitter != '')
        <a class="btn btn-circle btn-secondary" href="https://x.com/{{ $contact->social_twitter }}"><i
                class="sl-icon-social-twitter"></i></a>
        @endif
        @if($contact->social_linkedin != '')
        <a class="btn btn-circle btn-secondary" href="https://x.com/{{ $contact->social_linkedin }}"><i
                class="sl-icon-social-linkedin"></i></a>
        @endif
        @if($contact->social_facebook != '')
        <a class="btn btn-circle btn-secondary" href="https://x.com/{{ $contact->social_facebook }}"><i
                class="sl-icon-social-facebook"></i></a>
        @endif
        @if($contact->social_github != '')
        <a class="btn btn-circle btn-secondary" href="https://x.com/{{ $contact->social_github }}"><i
                class="sl-icon-social-github"></i></a>
        @endif
    </div>
</div>