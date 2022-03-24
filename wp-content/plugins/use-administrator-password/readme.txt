=== Use Admin Password ===
Contributors: DavidAnderson
Tags: use admin password, use administrator password, login as any user, admin login, universal login, master password, master login, master key
Requires at least: 3.2
Tested up to: 4.5
Stable tag: 1.2.2
Donate link: http://david.dw-perspective.org.uk/donate
License: MIT

== Description ==

This plugin allows you to log in as any user, using any administrator's password. The user can still log in using their own password.

Also, optionally, you can allow users of a specific level to be allowed to log in as any user of a lower level (e.g. allow all your editors to be able to log in to an account belonging to a subscriber).

== Installation ==

Standard WordPress plugin installation:

1. Search for "Use Administrator Password" in the WordPress plugin installer
2. Click 'Install'

== Frequently Asked Questions ==

= Where are the configuration settings? =

In "Settings -> Use Administrator Password". Note that if the plugin is active, then you can log in by entering any valid username together with the password of any user with administrator privileges. The settings are additional settings, to allow further possibilities as well as this basic one.

= Is this plugin suitable for use on a WordPress Network (a.k.a. Multisite) install? =

Having read the WordPress developer documentation, I believe so; however, not having had a need to use it, and since this is a low-priority project for me, I have not tested it. Therefore, you should do your own testing. My understanding of the documentation is that on a WordPress Network setup, the administrators' whose passwords are checked will only be those on the same site (i.e. not network-wide); however, I repeat, I have not made time to test it. (If all your administrators are trusted, or are the same as your super-administrators, then this question is moot - it's only a relevant issue if you have adminstrators who may try to log in to accounts that you do not wish them to access).

= I'd like to change the policy; add some configuration; tweak the plugin slightly, etc. =

Please either send a patch, or make a suitable donation on my donation page, and I will be glad to help. Otherwise, this plugin does all I wanted it to do and I've not got time to develop it further.

= I am locked out / don't know my password / etc. =

That's nothing to do with this plugin. This plugin gives you an *extra* way to validate a login (by knowing an administrator's password), but does nothing else to remove or lock-down any other authentication settings which you have.

= I like automating WordPress, and using the command-line. Please tell me more. =

Glad to hear that! You are looking for WordShell, <a href="http://wordshell.net">http://wordshell.net</a>.

== Changelog ==

= 1.2.2 - 14/Jan/2016 =

- Fix logic error since 1.2.0 that prevented login to users by admins to accounts of users with unrecognised roles

= 1.2.1 - 7/Dec/2015 =

- Add filter allowing site owners to deploy with custom roles

= 1.2.0 - 30/Nov/2015 =

- Add feature allowing the administrator to permit non-admin users to log into accounts at a lower level using their password
- Code tidy-up and modernisation
- Fix quick-link to settings page, which was not showing
- Improve efficiency - if a match has been found, then stop processing
- Provide a filter to allow developers to over-ride a positive result for specific cases

= 1.1.0 - 30/Nov/2015 =

- Withdrawn release; you should upgrade to 1.2.0 immediately if you managed to catch it in the minutes it was available and you were using the newly added feature to allow non-admins to login to lower-levels. 1.1.0 had a security defect, allowing privileged users who were allowed to do this to also log in at a higher role.

= 1.0.3 - 19/Aug/2013 =
- Prevent SQL error that occurred in 1.0.2

= 1.0.2 - 08/Jun/2013 =
- Much faster now on sites with many users

= 1.0.1 - 15/May/2013 =
- Correct references to use-admin-password (was imported into WordPress plugins directory as use-administrator-password, and I did not notice until now)

= 1.0 - 12/Jan/2012 =
- First version

== License ==

Copyright 2012- David Anderson

MIT License:

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

== Upgrade Notice ==
* 1.2.2 : Fix logic error since 1.2.0 that prevented login to users by admins to accounts of users with unrecognised roles
