<div class="row g-3">
    <div class="col-md-6"><label for="name" class="form-label">Dentist name <span class="text-danger">*</span></label><input id="name" name="name" class="form-control" value="{{ old('name', $dentist->name ?? '') }}" required maxlength="255"></div>
    <div class="col-md-6"><label for="specialization" class="form-label">Specialization <span class="text-danger">*</span></label><input id="specialization" name="specialization" class="form-control" value="{{ old('specialization', $dentist->specialization ?? '') }}" required maxlength="255" placeholder="e.g. Orthodontics"></div>
    <div class="col-md-6"><label for="email" class="form-label">Email <span class="text-danger">*</span></label><input type="email" id="email" name="email" class="form-control" value="{{ old('email', $dentist->email ?? '') }}" required maxlength="255"></div>
    <div class="col-md-6"><label for="phone" class="form-label">Phone <span class="text-danger">*</span></label><input id="phone" name="phone" class="form-control" value="{{ old('phone', $dentist->phone ?? '') }}" required maxlength="50"></div>
</div>

