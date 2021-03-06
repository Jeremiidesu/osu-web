###
#    Copyright 2015-2017 ppy Pty. Ltd.
#
#    This file is part of osu!web. osu!web is distributed with the hope of
#    attracting more community contributions to the core ecosystem of osu!.
#
#    osu!web is free software: you can redistribute it and/or modify
#    it under the terms of the Affero GNU General Public License version 3
#    as published by the Free Software Foundation.
#
#    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#    See the GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

{div, h1, span} = React.DOM
el = React.createElement

ProfilePage.HeaderInfo = ({user}) ->
  div className: 'profile-info',
    el UserAvatar, user: user, modifiers: ['profile']
    div className: 'profile-info__details',
      if user.isSupporter
        el Icon,
          name: 'heart'
          parentClass: 'profile-info__supporter-icon'
          title: osu.trans('users.show.is_supporter')
      h1 className: 'profile-info__name', user.username
      # hard space if no title
      span className: 'profile-info__title', user.title ? '\u00A0'
      div className: 'profile-info__flags',
        el FlagCountry, country: user.country
    div
      className: 'profile-info__bar hidden-xs'
      style:
        backgroundColor: "##{user.profile_colour}" if user.profile_colour?
