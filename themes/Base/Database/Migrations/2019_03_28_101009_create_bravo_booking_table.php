<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Booking\Models\Booking;

class CreateBravoBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bravo_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',64)->nullable();

            $table->integer('tour_id');
            $table->date('tour_date');
            $table->integer('customer_id')->default(0);

            $table->integer('total_member')->default(1);
            $table->smallInteger('adult_no')->default(0);
            $table->smallInteger('children_no')->default(0);
            $table->smallInteger('infant_no')->default(0);
            $table->text('member_detail')->nullable();
            $table->string('currency',5)->default('EUR');
            $table->decimal('tour_price', 8, 2)->default(0);

            $table->boolean('has_discount')->default(0);
            $table->boolean('has_coupon')->default(0);
            $table->string('coupon_code', 10)->nullable();
            $table->smallInteger('discount')->default(0);
            $table->enum('discount_type', \Modules\Tour\Models\TourDiscount::getDiscountTypes())->default(\Modules\Tour\Models\TourDiscount::DISCOUNT_TYPE_FIXED);
            $table->decimal('discount_price', 8, 2)->default(0);
            $table->decimal('total_price',8,2)->nullable();

            $table->string('payment_id')->nullable();
            $table->enum('payment_gateway', Booking::getPaymentGateways())->default(Booking::DEFAULT_PAYMENT);
            $table->text('payment_details')->nullable();
            $table->text('customer_review')->nullable();

            $table->enum('deposit_type', [Booking::FULL_PAYMENT, Booking::PARTIAL_PAYMENT])->default(Booking::FULL_PAYMENT);
            $table->decimal('deposit',8,2)->nullable();
            $table->tinyInteger('is_paid')->default(0);

            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->string('email',255)->nullable();
            $table->string('phone_no',255)->nullable();
            $table->string('mobile_no',255)->nullable();
            $table->string('nationality',255)->nullable();
            $table->string('address',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('postal_code',255)->nullable();
            $table->string('country',255)->nullable();
            $table->text('additional_contacts',255)->nullable();
            $table->text('customer_notes')->nullable();

            $table->integer('transport_id');
            $table->integer('hotel_id')->default(0);
            $table->text('transport_details')->nullable(); // json format {key: value}

            $table->unsignedInteger('invoice_inc_no');
            $table->string('invoice_no', 10)->nullable();
            $table->string('invoice_pdf_path')->nullable();
            $table->dateTime('invoice_created_at')->nullable();
            $table->dateTime('invoice_updated_at')->nullable();

            $table->boolean('is_cancelled')->default(0);
            $table->integer('cancellation_inc_no')->nullable();
            $table->string('cancellation_no', 15)->nullable();
            $table->string('cancellation_pdf_path')->nullable();
            $table->dateTime('cancelled_at')->nullable();

            $table->boolean('is_mail_sent')->default(0);
            $table->string('status',30)->nullable();
            $table->string('lang')->default('en');
            $table->integer('create_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->integer('p_booking_id')->nullable();
            $table->integer('p_order_id')->nullable();
            $table->boolean('step_completed')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bravo_bookings');
    }
}
