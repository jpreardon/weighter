class ApplicationController < ActionController::Base
    before_action :require_user

    private

      def require_user
        if session[:username] == ENV.fetch('HTTP_USER')
          true
        else
          load_user
        end
      end

      def load_user
        result = authenticate
        if result == 401
          return 401
        elsif result == true
          session[:username] = ENV.fetch('HTTP_USER')
        end
      end

      def authenticate
        authenticate_or_request_with_http_digest do |username|
          if username == ENV.fetch('HTTP_USER')
            ENV.fetch('HTTP_PASSWORD')
          else
            false
          end
        end
      end
      
end