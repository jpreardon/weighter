# Worklog

## TODO

- Create delete form
- Create basic visualization

## 2022-10-01

I'm tired of logging in with HTTP auth every day, so I'll add some sort of basic auth scheme. On the target server, I don't seem to have access to the HTTP auth information, so I'll have to roll my own. Given the low security needs of this particular application, I'll just store the username and password in the config.php file. I'll also set a cookie so I don't have to log in every time.

Before I do that, I'm going to refactor the code do reduce some of the duplicate HTML. I'll come back to this branch in a bit.
Refactor the HTML a bit so there's not so much duplication in the files.

- Move common HTML to functions.php
- Simple login page

## 2022-08-28

- Create edit form
- Handle db errors more gracefully (by adding a line to the config)
- Include example config and sql files, update readme.
- Migrate from heroku. (merge php-version branch to master)

## 2022-08-27

This project hasn't been touched in over 2 years now. However, it gets used daily. Currently, it needs several patches, and Heroku is shutting down their free tier in a couple months. So, I think it's time to simplify.

Web developers everywhere will cringe, because I'm going with PHP :) I just need a way to put one weight into a database daily, and visualize the past few days. A framework of any kind seems like overkill for this, and I'm not good at keeping up the dependencies. 

- Wipe out (almost) everything from previous project
- Get basic PHP page running
- Connect PHP to MySQL to list 7 days worth of (formatted) weights
- Update readme, set up dark mode, because that's important.
- Add meta tag for slightly better mobile sizing.
- Set up test database.
- Create input form. Put CSS in external file.
- Make dark mode styles more readable.

## 2020-07-04

- Merged all of dependabot's pull requests
- Change number of weights returned by default to 7 to get weekly averages
- Bump rails version to 6.0.3.2

## 2020-04-10

- Update rails and sass versions due to security vulnerabilities 
- Update bootstrap gem (getting compile errors in production)
- Going back to rails-sass 5 to see if it fixes prod errors

## 2020-03-14

I have the labels in the columns, but they aren't displaying because [you can't add text to a rect](https://stackoverflow.com/questions/20644415/d3-appending-text-to-a-svg-rectangle). That's really no big thing, but I need to append a <g> element, then put the rectangle and text inside. Adding to the todo list. For now, I'm putting this project aside to work on something else.

For this last checkin, I cleaned things up a bit, and made some other things more dirty.

- Update gem versions
- Fix typo in gemfile, upgrade js packages with yarn

## 2020-03-09

- Add in-column labels on small screen sizes.

## 2020-03-08 

Bar chart works ok on desktop, although, there is a problem with y-axis (in production only) label overlapping. On mobile, there isn't enough space for the axis though.

- Remove axis and labels on small screen sizes
- Fix label/weight collision in left axis

## 2020-03-01

Let's wrap up this bar chart

- Add x and y axis, remove weight labels in chart
- Add y axis label
- Refactor margin code

## 2020-02-23

Getting back to this after a few days off. I tried adding a time scale to my chart rather than the ordinal that was called for in the tutorial. Going back to ordinal, but ultimatly, I think I'll go for a line chart.

- Get bar chart working agin
- Make the SVG size dynamic based on the (current) viewport width
- Looks like crap on narrow widths.

## 2020-02-17

- Time for [step 3](https://bost.ocks.org/mike/bar/3/) of charting...

## 2020-02-16

Let's try to get a simple chart in here...

- d3! I kind of know what needs to get done here...
  - Add reference to d3
  - On the index page, put the weights into an array so d3 can read it
  - draw a simple chart
  - Profit!

- There's a [d3 gem](https://rubygems.org/gems/d3-rails/versions/5.9.2), but I don't really think I need it at this point. I just added a reference to the d3 site.
- Did the [most basic of bar charts](https://bost.ocks.org/mike/bar/) in DIV form. This is like the hello world of d3 (I think).
- Converted the DIV chart to SVG. Yes, I'm just following "Let's Make a Bar Chart..."


## 2020-01-29

- Check that session username matches the server username (oops)
- Refactor auth code
- Clear session username variable when user names don't match

## 2020-01-28

Auth!!! (this is taking forever)

[Stack Overflow delivers](https://stackoverflow.com/questions/6358284/get-password-inside-authenticate-or-request-with-http-digest)

The sessions were not persisting after the browser was closed. I thought this was a localhost thing, but the same happened in prod. Turns the default expiry for sessions is "session". I added a line to the config/application.rb file to set the expiry to 30 days. 

## 2020-01-26

- Replace some more hard-coded text with i18l.

## 2020-01-25

- Getting local dev environment set--just to get off of Cloud9 (it's nice, but I'd rather run on my local):
    - Started with [this post](https://usabilityetc.com/articles/ruby-on-mac-os-x-with-rvm/) which points to the [RVM install page](https://rvm.io/rvm/install)
    - Ran the install script (I already had GPG installed)
    - ```bundle install``` this took a long time, it failed to instally msql, which I only need for prod anyway, so I ```bundle install --without production```
    - Tried to run the rails server, it failed with a message about yarn being out of date
    - Install yarn, try to run server again, same problem run ```yarn```, runs, but there's an "Error loading the 'postgresql' Active Record adapter". [Stack overflow delivers](https://stackoverflow.com/questions/52316760/error-loading-the-postgresql-active-record-adapter-missing-a-gem-it-depends-o).
    - Ran rails server again, now it complains about migrations, as expected so ```rails db:migrate```
    - Now it runs locally, but I realized that it doesn't play nice when the DB is empty. I should fix that at some point--adding to TODO.
    - The few tests I have are failing, but they are failing on the Cloud9 environment too. Another thing for the TODO list. 
    - Update .gitignore for all sqllite files
    - Updated heroku and pushed
    - Deleted AWS instances, that will save me about $2 a month!!!
- Deal with an empty weights table more gracefully instead of blowing up.
- Replace text on index page with i18l

## 2020-01-23

Continuing with authentication...

- Research
  - [How Rails Sessions Work](https://www.justinweiss.com/articles/how-rails-sessions-work/)

## 2020-01-22

Fix user auth, I need to log in daily. I don't need a whole multi-user thing, but auth needs to be cached.

- Research
  - [Rails HTTP Digest Authentication](https://guides.rubyonrails.org/action_controller_overview.html#http-authentications)
- Replace basic auth with http digest

## 2020-01-21

Rename app:

- Change the module name in application.rb
- Add the application-title to the local, use it in the view titles
- Search through files and replace any last references to "Rewards"
- Update heroku name, DNS, git repo (not renaming database yet, added to TODO)

## 2020-01-20

I've been using this to track weight since November. Today, I went ahead and removed the old HTML pages from my site. It's now all in the Rails app.

I was going to start adding more functionality to track more stuff things like water consumption, exercise and other good habits I wanted to cultivate. Then two things happened in the intervening months:

- I read a [book about forming good habits](https://gretchenrubin.com/books/better-than-before/about-the-book/). One of of my takeaways was that for me, tying rewards like beer to habits like exercise (just to take one example), might not be that effective. It may be better just to concentrate on forming the good habits like exercise more, drink less beer.
- I found this [Streaks app](https://streaksapp.com/) that does almost exactly what I wanted to do. It even looks quite a bit like I wanted the UI to look for this, but way better than what I would have done.

So, I've been using Streaks for a couple days, love it. So, I'm going to shift gears a bit on this project. I don't need to track all sorts of things right now, I'll just do weight--which I'm already doing. I'm going to adjust the todo list a bit and try to wrap this up soon.

I found a couple really basic design ideas, those are now in the archive directory here.

## 2019-12-21

- Imported all the old weights I could find on spreadsheets (over 1,500 datapoints from years ago).
- Dropped old "weight" table

## 2019-11-12

Add min/max/average weights to index page

## 2019-11-11

- Make the weight input a number field
- Load fewer weight records

## 2019-11-10

- Add a helper to format the dates
- Default new date entry to today and make it a date field
- Refactor weight form to partial, make date read-only on edit.
- Add bootstrap and style pages.
- Tweak styles a bit
- Make the weight#index the root page
- Abstract text to i18n file.

At this point, this app is working as good as the previous one. With the added bonus of being able to edit weights. There are a couple more things I'd like to do before adding additional tracking.

## 2019-11-09

After some additional thought, I've decided to forego the (secured-password) user auth in favor of getting weight tracking working. After all, I'm the only user of this. I would like something simple though. I'll look into basic http auth.

- Research basic http-auth
- Add super basic http auth with [HttpAuthentication](https://api.rubyonrails.org/classes/ActionController/HttpAuthentication/Basic.html)
- Make sure tests test authentication
- Change production database adapter from postgresql to mysql

Now lets get the really basic weight tracking working...

- Create weight resource
- Set precision on weight field and migrate
- Add some super basic validations to the weight model
- Add actions and views for weight
- Import old weight data
- Push to prod, and use
- Shut off the old API (the old DB table is still there)
 
## 2019-11-06

Time to get user auth going...

- Thought about using [Devise](https://github.com/plataformatec/devise) but decided against it after looking at their README where they reommend rolling your own for beginners. So, it's back the the Hartl book :)
- Removed this from /views/layouts/application.html.erb
- Installed webpack
- Got up to chapter 4 in the book, subscription required...


## 2019-11-04

I'm going to run this first bit right off my [worklog from the float plan app](https://github.com/jpreardon/float-plan/blob/master/WORKLOG.md)...

- Set up a new environment on Cloud 9
- Rails 5 was already installed in the environment, upgraded to 6.
- Generate new SSH key an add to github
- Fetch a-new-day branch of the rewards repo from github
- Create new rails application
- Install yarn
- Update the gem file/bundle install
- Make a simple 'hello world' modification
- Create production group for postgresql gem
- Install heroku, deploy to production

## 2019-11-03

I'm going to take this in a different direction, hopefully one that will yield faster results. The prior attempt at this was built on Express for the API and some very basic HTML/CSS/Javascript. I have been using it almost daily for quite a while, maybe two years.

In the interest of getting things done, I'm going to switch over to Ruby on Rails for the whole thing. If I ever want to plug in a different sort of front end, like a mobile app, Rails can serve as the API with little or no updates.

Here's a rough plan

- Get environment set up
- Get basic user auth working (I think I steal from the Sail Club App for this)
- Add weight tracking
- Import old weight data
- Push to prod, and use
- Add a simple visualization
- Post MVP trackers
  - Water
  - Exercise
  - Good habits (like journaling etc.)
  - Meal log