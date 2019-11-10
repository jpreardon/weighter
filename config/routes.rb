Rails.application.routes.draw do
  
  resources :weights
  root 'weights#index'
  get 'static_pages/home'
  get 'static_pages/about'
end
