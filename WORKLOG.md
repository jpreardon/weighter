# Worklog

## TODO

- Get tests running
- Remove static pages controller and pages
- Test coverage for weights
- Add a simple visualization
- Get more advanced with visualization?
- Rename database
- Get a real web server running in prod https://devcenter.heroku.com/articles/ruby-default-web-server  

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