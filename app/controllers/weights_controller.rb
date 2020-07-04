class WeightsController < ApplicationController
  def new
    @weight = Weight.new
  end
  
  def create
    @weight = Weight.create(weight_params)
    if @weight.save
      flash[:success] = "Weight added!"
      redirect_to weights_path
    else
      render 'new'
    end
  end
  
  def show
    @weight = Weight.find(params[:id])
  end
  
  def index
    # Show about 1 week worth of weights by default, allow all or any
    # other number to be shown with by setting the :numrecords
    case params[:numrecords]
    when "all"
       @weights = Weight.all.order(date: :desc)
    when String
      @weights = Weight.all.order(date: :desc).first(params[:numrecords].to_i)
    else
       @weights = Weight.all.order(date: :desc).first(7)
    end
  end
  
  def edit
    @weight = Weight.find(params[:id])
  end
  
  def update
    @weight = Weight.find(params[:id])
    if @weight.update_attributes(weight_params)
      flash[:success] = "Weight updated!"
      redirect_to weights_path
    else
      render 'edit'
    end
  end
  
  def destroy
    Weight.find(params[:id]).destroy
    flash[:success] = 'Weight deleted'
    redirect_to weights_path
  end
  
  private
  
    def weight_params
      params.require(:weight).permit(:date, :weight)
    end
    
end