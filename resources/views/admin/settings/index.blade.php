@extends('admin.layout')

@section('title', 'Website Settings - Admin Dashboard')
@section('page_header', 'Website Settings')

@section('content')

<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card card-custom p-4">
      <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
          <h4 class="fw-bold text-dark mb-1"><i class="fas fa-sliders-h text-success me-2"></i> General Website Settings</h4>
          <p class="text-secondary small mb-0">Update agency contact information, phone numbers, WhatsApp, and footer text.</p>
        </div>
      </div>

      <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label class="form-label fw-bold">Agency / Website Name</label>
            <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name']) }}" class="form-control" required>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-bold">Tagline</label>
            <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline']) }}" class="form-control">
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <label class="form-label fw-bold">Contact Phone Helpline</label>
            <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone']) }}" class="form-control" required>
          </div>

          <div class="col-md-4">
            <label class="form-label fw-bold">Official Contact Email</label>
            <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email']) }}" class="form-control" required>
          </div>

          <div class="col-md-4">
            <label class="form-label fw-bold">Official WhatsApp Number</label>
            <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" class="form-control" placeholder="7001420469" required>
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold">Office Address</label>
          <input type="text" name="address" value="{{ old('address', $settings['address']) }}" class="form-control" required>
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold">Footer About Paragraph</label>
          <textarea name="footer_about" rows="4" class="form-control">{{ old('footer_about', $settings['footer_about']) }}</textarea>
        </div>

        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
          <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4">Cancel</a>
          <button type="submit" class="btn btn-success px-5 fw-bold rounded-pill">
            <i class="fas fa-save me-1"></i> Save Website Settings
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
