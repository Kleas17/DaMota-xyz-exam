<x-app :title="$week->name">
    <main class="container-wide two-cols space-y-8">

        <section>
            <h1>
                {{ $week->name }} <small>{{ trans_choice('tracks.count', $week->tracks_count) }}</small>
            </h1>

            <ol class="chart">
                @foreach($tracks as $track)
                <li>
                    <a href="{{ route('app.tracks.show', ['week' => $week->uri, 'track' => $track]) }}">
                        <span class="position">{{ $loop->iteration }}.</span>
                        <img src="{{ $track->player_thumbnail_url }}" alt="">
                        <div class="details">
                            <h1 class="truncate">{{ $track->artist }}</h1>
                            <h2 class="truncate">{{ $track->title }}</h2>

                            <div class="metadata">
                                <div class="metadata-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                        <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $track->user->username }}</span>
                                </div>

                                <div class="metadata-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                        <path d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                                    </svg>
                                    <span>{{ trans_choice('tracks.likes', $track->likes_count) }}</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <svg class="size-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                    </a>
                </li>
                @endforeach
            </ol>
        </section>

        <div>
            <div class="block block-content space-y-8">
                
                @if($isCurrent)
                <div class="title">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z" clip-rule="evenodd" />
                    </svg>                      
                    <div>
                        <h1>Il est encore temps</h1>
                        <h2>{{ $week->name }}</h2>
                    </div>
                </div>

                <p>
                    Les contributions pour la semaine {{ $week->weekNumber }} sont ouvertes.
                </p>

                <div class="space-y-2">
                    <dl>
                        <dt>Temps restant</dt>
                        <dd>{{ round(now()->diffInHours($week->week_ends_at)) }}h</dd>

                        <dt>Limite</dt>
                        <dd>{{ $week->week_ends_at->format("d/m/Y H:i:s") }} UTC</dd>
                    </dl>

                    @can('create', App\Models\Track::class)
                    <div>
                        <a href="{{ route('app.tracks.create') }}">
                            <button class="secondary w-full">Contribuer</button>
                        </a>
                    </div>
                    @endcan
                </div>
                @else
                <div class="title">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75ZM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 0 1-1.875-1.875V8.625ZM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 0 1 3 19.875v-6.75Z" />
                    </svg>                   
                    <div>
                        <h1>Synthèse de la semaine</h1>
                    </div>
                </div>

                <div class="space-y-2">
                    <dl>
                        <dt>Contributions</dt>
                        <dd>{{ trans_choice('tracks.count', $week->tracks_count) }}</dd>

                        <dt>Période</dt>
                        <dd>Du {{ $week->week_starts_at->format("d/m/Y") }} au {{ $week->week_ends_at->format("d/m/Y") }}</dd>
                    </dl>
                </div>
                @endif

            </div>
        </div>
    </main>
</x-app>