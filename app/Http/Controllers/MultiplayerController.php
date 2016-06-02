<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace App\Http\Controllers;

use App\Models\Multiplayer\Match;
use App\Transformers\Multiplayer\MatchTransformer;
use App\Transformers\Multiplayer\EventTransformer;
use Request;

class MultiplayerController extends Controller
{
    protected $section = 'multiplayer';

    public function getMatch($match_id)
    {
        $match = Match::findOrFail($match_id);

        $match = fractal_item_array(
            $match,
            new MatchTransformer
        );

        return view('multiplayer.match', compact('match'));
    }

    public function getMatchHistory($match_id)
    {
        $since = Request::input('since', 0);

        $match = Match::findOrFail($match_id);

        $events = $match->events()
            ->where('event_id', '>', $since)
            ->default()
            ->get();

        return fractal_collection_array(
            $events,
            new EventTransformer,
            implode(',', ['game.beatmap', 'game.scores', 'user'])
        );
    }
}
