<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>
<?php
if (!empty(session()->getFlashdata('success'))) { ?>
    <div class="alert alert-success">
        <?php echo session()->getFlashdata('success'); ?>
    </div>
<?php }

if (!empty(session()->getFlashdata('error'))) { ?>
    <div class="alert alert-danger">
        <?php echo session()->getFlashdata('error'); ?>
    </div>
<?php }

echo form_open('email/send') ?>

<div class="card text-white bg-primary mb-3" style="width: 30rem;">
    <div class="card-header bg-primary mb-3">Send Email</div>
    <br>
    <div class="input-field">
        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
        <input type="email" name="email" style="width: 20rem;" placeholder="Email">

    </div>

    <div class=" input-field">
        <label for="subject" class="col-sm-2 col-form-label">Subject</label>
        <input type="text" name="subject" class="validate" style="width: 20rem;" placeholder="Subject">

    </div>
    <div class=" input-field">
        <label for="message" class="col-sm-2 col-form-label">Pesan</label>
        <textarea name="message" class="materialize-textarea" style="width: 20rem;" placeholder="Message"></textarea>
    </div>
    <br>
</div>
<div class="col-auto">
    <button type="submit" class="btn btn-primary mb-2">Kirim Email</button>
</div>

<?= form_close() ?>
</form>

<?= $this->endSection(); ?>