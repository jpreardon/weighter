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
    @weights = Weight.all.order(date: :desc)
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