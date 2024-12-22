</div>

<!-- BEGIN: Page content-->
<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- <div class="row">
                        <a class="btn btn-secondary" href="<?=base_url('calibrate')?>" role="button">Calibrate Pin</a>
                    </div> -->
                    <div class="row">
                        <div class="col text-center">
                            <div class="easypie" data-percent="100" data-bar-color="#00bcd4" data-size="110" data-line-width="8"><span class="easypie-data text-info" style="font-size:32px;"><?=($tdel) ?></span></div>
                            <h6 class="mb-0 mt-3 font-15 text-muted font-weight-normal">Total Delegates</h6>
                        </div>
                        <div class="col text-center">
                            <div class="easypie" data-percent="<?=($rpin/10) ?>" data-bar-color="#00bcd4" data-size="110" data-line-width="8"><span class="easypie-data text-info" style="font-size:32px;"><?=($rpin) ?></span></div>
                            <h6 class="mb-0 mt-3 font-15 text-muted font-weight-normal">Remo pin</h6>
                        </div>
                        <div class="col text-center">
                            <div class="easypie" data-percent="<?=($rpin/10) ?>" data-bar-color="#00bcd4" data-size="110" data-line-width="8"><span class="easypie-data text-info" style="font-size:32px;"><?=($ipin) ?></span></div>
                            <h6 class="mb-0 mt-3 font-15 text-muted font-weight-normal">Ijebu pin</h6>
                        </div>
                        <div class="col text-center">
                            <div class="easypie" data-percent="<?=($epin/10) ?>" data-bar-color="#00bcd4" data-size="110" data-line-width="8"><span class="easypie-data text-info" style="font-size:32px;"><?=($epin) ?></span></div>
                            <h6 class="mb-0 mt-3 font-15 text-muted font-weight-normal">Egba pin</h6>
                        </div>
                        <div class="col text-center">
                            <div class="easypie" data-percent="<?=($rpin/10) ?>" data-bar-color="#00bcd4" data-size="110" data-line-width="8"><span class="easypie-data text-info" style="font-size:32px;"><?=($aapin) ?></span></div>
                            <h6 class="mb-0 mt-3 font-15 text-muted font-weight-normal">AdoOdo pin</h6>
                        </div>
                        <div class="col text-center">
                            <div class="easypie" data-percent="<?=($rpin/10) ?>" data-bar-color="#00bcd4" data-size="110" data-line-width="8"><span class="easypie-data text-info" style="font-size:32px;"><?=($yepin) ?></span></div>
                            <h6 class="mb-0 mt-3 font-15 text-muted font-weight-normal">Yewa pin</h6>
                        </div>
                        <div class="col text-center">
                            <div class="easypie" data-percent="<?=($rpin/10) ?>" data-bar-color="#00bcd4" data-size="110" data-line-width="8"><span class="easypie-data text-info" style="font-size:32px;"><?=($opin) ?></span></div>
                            <h6 class="mb-0 mt-3 font-15 text-muted font-weight-normal">Online pin</h6>
                        </div>
                        <!-- <div class="col text-center">
                            <div class="easypie" data-percent="<?=($spin/10) ?>" data-bar-color="#00bcd4" data-size="110" data-line-width="8"><span class="easypie-data text-info" style="font-size:32px;"><?=($spin) ?></span></div>
                            <h6 class="mb-0 mt-3 font-15 text-muted font-weight-normal">Sold pin</h6>
                        </div> -->
                        <div class="col text-center">
                            <div class="easypie" data-percent="<?=($upin/10) ?>" data-bar-color="#00bcd4" data-size="110" data-line-width="8"><span class="easypie-data text-info" style="font-size:32px;"><?=($upin) ?></span></div>
                            <h6 class="mb-0 mt-3 font-15 text-muted font-weight-normal">Used pin</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h6>Print Delegate tags</h6>
            <div class="container">
                <form action="<?=base_url('printtag')?>" method="post">
                    <div class="mb-3 row">
                        <label for="range" class="col-sm-1-12 col-form-label">Range</label>
                        <div class="col-sm-1-12">
                            <input type="text" class="form-control" name="range" id="range" placeholder="">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="range" class="col-sm-1-12 col-form-label">LB</label>
                        <div class="col-sm-1-12">
                            <select name="lb" id="" class="form-control">
                                <option value="">Select a Local Branch</option>
                                <option value="all">All</option>
                                <option value="Ijebu">Ijebu</option>
                                <option value="Remo">Remo</option>
                                <option value="Egba">Egba</option>
                                <option value="Adoodo">Adoodo</option>
                                <option value="Yewa">Yewa</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Print</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <h6>Print Official tags</h6>
            <div class="container">
                <form action="<?=base_url('printotag')?>" method="post">
                    <div class="mb-3 row">
                        <label for="range" class="col-sm-1-12 col-form-label">Range</label>
                        <div class="col-sm-1-12">
                            <input type="text" class="form-control" name="range" id="range" placeholder="">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="range" class="col-sm-1-12 col-form-label">LB</label>
                        <div class="col-sm-1-12">
                            <select name="lb" id="" class="form-control">
                                <option value="">Select a Local Branch</option>
                                <option value="Ijebu">Ijebu</option>
                                <option value="Remo">Remo</option>
                                <option value="Egba">Egba</option>
                                <option value="Adoodo">Adoodo</option>
                                <option value="Yewa">Yewa</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Print</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- <div class="col-md-8">
            <h6>Permit Vendor to Sync</h6>
            <div class="container">
                <p>Clear Google Sheet after Sync & Lock Sync Again</p>
                <div class="row">
                    <?php foreach($vendors as $key => $vendor): ?>
                    <div class="col">
                        <p>Vendor: <?=$vendor['name']?></p>
                        <p><?php if ($vendor['locked']): ?>
                        <a class="btn btn-primary" href="<?=base_url('lock/'.$vendor['id'])?>" role="button">Unlock Sync</a>
                        <?php else: ?>
                        <a class="btn btn-secondary" href="<?=base_url('lock/'.$vendor['id'])?>" role="button">Syncing</a>
                        <?php endif; ?></p>
                    </div>
                <?php endforeach?>
                </div>
            </div>
        </div> -->
        <div class="col-md-4">
            <h6>Print Visitors/Lecturers Tag</h6>
            <div class="container">
                <form action="<?=base_url('printvtag')?>" method="post">
                    <div class="mb-3 row">
                        <label for="range" class="col-sm-1-12 col-form-label">Range</label>
                        <div class="col-sm-1-12">
                            <input type="text" class="form-control" name="range" id="range" placeholder="">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="range" class="col-sm-1-12 col-form-label">TYPE</label>
                        <div class="col-sm-1-12">
                            <select name="typer" id="" class="form-control">
                                <option value="">Select a Tag Type</option>
                                <option value="v">Visitors</option>
                                <option value="l">Lecturer</option>
                                <option value="o">Official</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Print</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <h6>Print From my Pins</h6>
            <div class="container">
                <form action="<?=base_url('printpins')?>" method="post">
                    <div class="mb-3 row">
                        <label for="range" class="col-sm-1-12 col-form-label">Used/Not</label>
                        <div class="col-sm-1-12">
                            <select name="typer" id="" class="form-control">
                                <option value="">Select a Pin Type</option>
                                <option value="used">Used</option>
                                <option value="nused">Not yet Used</option>
                                <option value="all">All</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Print Pins</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

</div>
<!-- END: Page content-->

<!-- BEGIN: Page backdrops-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div><!-- END: Page backdrops-->
