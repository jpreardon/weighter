Rails.application.routes.draw do
  
  resources :weights
  root 'static_pages#home'
  get 'static_pages/home'
  get 'static_pages/about'
end
