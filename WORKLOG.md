# Worklog

## TODO

- Post MVP trackers
  - Water
  - Exercise
  - Good habits (like journaling etc.)
  - Meal log
- Test coverage for weights
- Add a simple visualization
- Get user auth working? (I think I steal from the Float Plan App for this)
- Drop "weight" table
- Remove old web pages (from old app)

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