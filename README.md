#ARRL Centennial QSO Party Schedule Application

##Overview

[RDXA W1AW/2 Schedule Web Application](http://rdxa.com/w1aw-schedule) is designed for our club RDXA for its W1AW/2 New York operating on May, 2014. Since it had been launched, I've got several emails from other clubs, indicating their interests in using my application. So I modified the application to fit the needs of all the other clubs/states.

This application is FREE for amateur radio society, here is a [test site](w1aw-test), you can register and play. Be aware: all fields are required, but you can enter anything except password, you have to enter at least 6 characters or numbers for it, and it can't be the same as you call sign. All registered user have normal privilege, if you want to see what an Administrator can do, drop me a line, I'll give you an Administrator privilege to play with. [Contact me](contact.php) if you are interested.

##Clubs using this application

- [Rochester DX Association](http://www.rdxa.com/) [(New York, May 21 - 27)](http://rdxa.com/w1aw-schedule)
- [Puerto Rico Amateur Radio League](http://prarl.org/) [(Puerto Rico, Apr. 9 - 15, Oct. 23 - 29)](http://n2iw.com/prarl)
- [NR0X](http://nr0x.org/) [(Iowa, Mar. 26 - Apr. 1)](http://nr0x.org/w1aw-schedule)
- [Edmond Amateur Radio Society](http://www.k5eok.org/) [(Oklahoma, Aug. 13 - 19)](http://k5eok.org/w1aw-schedule)
- [Long Island DX Society](http://n1li.webs.com/) [(Maine, Aug. 27 - Sep. 2, Dec. 3 - 9)](http://n2iw.com/lidxs)
- [Eau Claire Amateur Radio Club](http://ecarc.org/) [(Wisconsin, July, 2 - 8)](http://ecarc.org/w1aw-schedule)
- [W8HC](http://www.w8hc.com/) [(West Virginia, Oct. 22 - 28)](http://w8tn.com/w1aw-8/)
- [KE7X](http://www.ke7x.com/) [(Montana, June 18 - 24)](http://w1awinmontana.org/scheduler)
- [Radio Amateurs of Northern Vermont](http://www.ranv.org/) [(Vermont, Mar. 26 - Apr. 1)](http://www.hamclass.net/w1aw-schedule)

##System Requirements

If your club has a suitable web hosting or better, a server, install it on your web hosting/server is the best choice, if your club doesn't have one, it's a good time to get one, the $4.95 starter web hosting service provided by qth.com (KA9FOX) is fine for this application, there are also other companies provide similar services.

This application uses PHP and MySQL, if your web hosting/server supports PHP and MySQL (most servers do), you probably could run this application on your web hosting/server.

If your club doesn't have suitable personnel to manage a website, I can host the application for your club, problem is my website is on a shared web hosting, it has limited databases and other resources. So please consider use your club's web hosting if you can.

##Basic Features
Here is some basic features

###User Management

Users can only be added by a Administrator. On our [test site](w1aw-test) you can register by yourself, but not on a real schedule website.

###Password Management

Users can change their passwords (old passwords needed), Administrators can give users their new passwords directly.

Passwords are encrypted before being stored in database, nobody can see any password, not even the Administrator.

###User Profile

Users can view their profiles, but can't edit them (except password); Administrators can edit users' profiles.

Reservation Function

Registered users can make reservations, or cancel their own reservations; Administrators can cancel anyone's reservations.

###My Slots

Users can display their own reserved time slots, or cancel them in the same page. Administrators can show any user's reserved time slots, or cancel them in the same page.
