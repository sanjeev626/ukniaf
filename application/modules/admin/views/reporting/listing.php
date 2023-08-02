<div class="row">
    <div class="col-lg-12">
        <div class="card" id="tasksList">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">All Tasks</h5>
                    <div class="flex-shrink-0">
                       <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create Task</button>
                            <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                       </div>
                    </div>
                </div>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                <form>
                    <div class="row g-3">
                        <div class="col-xxl-5 col-sm-12">
                            <div class="search-box">
                                <input type="text" class="form-control search bg-light border-light" placeholder="Search for tasks or something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <!--end col-->

                        <div class="col-xxl-3 col-sm-4">
                            <input type="text" class="form-control bg-light border-light" id="demo-datepicker" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" placeholder="Select date range">
                        </div>
                        <!--end col-->

                        <div class="col-xxl-3 col-sm-4">
                            <div class="input-light">
                                <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                    <option value="">Status</option>
                                    <option value="all" selected>All</option>
                                    <option value="New">New</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Inprogress">Inprogress</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-1 col-sm-4">
                            <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                Filters
                            </button>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </form>
            </div>
            <!--end card-body-->
            <div class="card-body">
                <div class="table-responsive table-card mb-4">
                    <table class="table align-middle table-nowrap mb-0" id="tasksTable">
                        <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" style="width: 40px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th class="sort" data-sort="id">task_order</th>
                                <th class="sort" data-sort="project_name">risk_number</th>
                                <th class="sort" data-sort="tasks_name">Task</th>
                                <th class="sort" data-sort="client_name">Client Name</th>
                                <th class="sort" data-sort="assignedto">Assigned To</th>
                                <th class="sort" data-sort="due_date">Due Date</th>
                                <th class="sort" data-sort="status">Status</th>
                                <th class="sort" data-sort="priority">Priority</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">

                            <?php 
                            $sn=1;
                            foreach($techincal_updates as $techincal_update){?>
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <?php echo $sn++;?>
                                    </div>
                                </th>
                                <td class="id"><a href="javascript:void(0);" class="fw-medium link-primary"><?php echo $techincal_update->task_order;?></a></td>
                                <td class="project_name"><a href="javascript:void(0);" class="fw-medium link-primary"><?php echo $techincal_update->risk_number;?></a></td>
                                <td>
                                    <div class="d-flex">
                                        <div class="flex-grow-1 tasks_name"><?php echo $techincal_update->updates;?></div>
                                        <div class="flex-shrink-0 ms-4">
                                            <ul class="list-inline tasks-list-menu mb-0">
                                                <li class="list-inline-item"><a href="apps-tasks-details.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a></li>
                                                <li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a></li>
                                                <li class="list-inline-item">
                                                    <a class="remove-item-btn" data-bs-toggle="modal" href="#deleteOrder">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                <td class="client_name">Robert McMahon</td>
                                <td class="assignedto">
                                    <div class="avatar-group">
                                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Frank">
                                            <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xxs" />
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Anna">
                                            <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xxs" />
                                        </a>
                                    </div>
                                </td>
                                <td class="due_date">25 Jan, 2022</td>
                                <td class="status"><span class="badge badge-soft-secondary text-uppercase">Inprogress</span></td>
                                <td class="priority"><span class="badge bg-danger text-uppercase">High</span></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!--end table-->
                    <div class="noresult" style="display: none">
                        <div class="text-center">
                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                            <h5 class="mt-2">Sorry! No Result Found</h5>
                            <p class="text-muted mb-0">We've searched more than 200k+ tasks We did not find any tasks for you search.</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    <div class="pagination-wrap hstack gap-2">
                        <a class="page-item pagination-prev disabled" href="#">
                            Previous
                        </a>
                        <ul class="pagination listjs-pagination mb-0"></ul>
                        <a class="page-item pagination-next" href="#">
                            Next
                        </a>
                    </div>
                </div>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<!--end row-->

<div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-5 text-center">
                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                <div class="mt-4 text-center">
                    <h4>You are about to delete a task ?</h4>
                    <p class="text-muted fs-14 mb-4">Deleting your task will remove all of
                        your information from our database.</p>
                    <div class="hstack gap-2 justify-content-center remove">
                        <button class="btn btn-link btn-ghost-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                        <button class="btn btn-danger" id="delete-record">Yes, Delete It</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end delete modal -->

<div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form class="tablelist-form" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="tasksId" />
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <label for="projectName-field" class="form-label">Project Name</label>
                            <input type="text" id="projectName-field" class="form-control" placeholder="Project name" required />
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="tasksTitle-field" class="form-label">Title</label>
                                <input type="text" id="tasksTitle-field" class="form-control" placeholder="Title" required />
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <label for="clientName-field" class="form-label">Client Name</label>
                            <input type="text" id="clientName-field" class="form-control" placeholder="Client name" required />
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <label class="form-label">Assigned To</label>
                            <div data-simplebar style="height: 95px;">
                                <ul class="list-unstyled vstack gap-2 mb-0">
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-2.jpg" id="james-forbes">
                                            <label class="form-check-label d-flex align-items-center" for="james-forbes">
                                                <span class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">James Forbes</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-3.jpg" id="john-robles">
                                            <label class="form-check-label d-flex align-items-center" for="john-robles">
                                                <span class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">John Robles</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-4.jpg" id="mary-gant">
                                            <label class="form-check-label d-flex align-items-center" for="mary-gant">
                                                <span class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Mary Gant</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-1.jpg" id="curtis-saenz">
                                            <label class="form-check-label d-flex align-items-center" for="curtis-saenz">
                                                <span class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Curtis Saenz</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-5.jpg" id="virgie-price">
                                            <label class="form-check-label d-flex align-items-center" for="virgie-price">
                                                <span class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-5.jpg" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Virgie Price</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-10.jpg" id="anthony-mills">
                                            <label class="form-check-label d-flex align-items-center" for="anthony-mills">
                                                <span class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-10.jpg" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Anthony Mills</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-6.jpg" id="marian-angel">
                                            <label class="form-check-label d-flex align-items-center" for="marian-angel">
                                                <span class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Marian Angel</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-10.jpg" id="johnnie-walton">
                                            <label class="form-check-label d-flex align-items-center" for="johnnie-walton">
                                                <span class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-7.jpg" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Johnnie Walton</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-8.jpg" id="donna-weston">
                                            <label class="form-check-label d-flex align-items-center" for="donna-weston">
                                                <span class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-8.jpg" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Donna Weston</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-9.jpg" id="diego-norris">
                                            <label class="form-check-label d-flex align-items-center" for="diego-norris">
                                                <span class="flex-shrink-0">
                                                    <img src="assets/images/users/avatar-9.jpg" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">Diego Norris</span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <label for="duedate-field" class="form-label">Due Date</label>
                            <input type="text" id="duedate-field" class="form-control" data-provider="flatpickr" placeholder="Due date" required />
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <label for="ticket-status" class="form-label">Status</label>
                            <select class="form-control" data-choices data-choices-search-false id="ticket-status">
                                <option value="">Status</option>
                                <option value="New">New</option>
                                <option value="Inprogress">Inprogress</option>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <label for="priority-field" class="form-label">Priority</label>
                            <select class="form-control" data-choices data-choices-search-false id="priority-field">
                                <option value="">Priority</option>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Add Task</button>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update Task</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end modal-->














<?php /* ?>
<div class="row">
  <div class="col-lg-12">
    <div class="card" id="tasksList">
      <div class="card-header border-0">
        <div class="d-flex align-items-center">
          <h5 class="card-title mb-0 flex-grow-1">All Tasks</h5>
          <div class="flex-shrink-0">
            <div class="d-flex flex-wrap gap-2">
              <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create Task</button>
              <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body border border-dashed border-end-0 border-start-0">
        <form>
          <div class="row g-3">
            <div class="col-xxl-5 col-sm-12">
              <div class="search-box">
                <input type="text" class="form-control search bg-light border-light" placeholder="Search for tasks or something...">
                <i class="ri-search-line search-icon"></i> </div>
            </div>
            <!--end col-->
            
            <div class="col-xxl-3 col-sm-4">
              <input type="text" class="form-control bg-light border-light flatpickr-input" id="demo-datepicker" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" placeholder="Select date range" readonly>
            </div>
            <!--end col-->
            
            <div class="col-xxl-3 col-sm-4">
              <div class="input-light">
                <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false">
                  <div class="choices__inner">
                    <select class="form-control choices__input" data-choices="" data-choices-search-false="" name="choices-single-default" id="idStatus" hidden="" tabindex="-1" data-choice="active">
                      <option value="all" data-custom-properties="[object Object]">All</option>
                    </select>
                    <div class="choices__list choices__list--single">
                      <div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="all" data-custom-properties="[object Object]" aria-selected="true">All</div>
                    </div>
                  </div>
                  <div class="choices__list choices__list--dropdown" aria-expanded="false">
                    <div class="choices__list" role="listbox">
                      <div id="choices--idStatus-item-choice-6" class="choices__item choices__item--choice choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="6" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Status</div>
                      <div id="choices--idStatus-item-choice-1" class="choices__item choices__item--choice is-selected choices__item--selectable" role="option" data-choice="" data-id="1" data-value="all" data-select-text="Press to select" data-choice-selectable="">All</div>
                      <div id="choices--idStatus-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Completed" data-select-text="Press to select" data-choice-selectable="">Completed</div>
                      <div id="choices--idStatus-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Inprogress" data-select-text="Press to select" data-choice-selectable="">Inprogress</div>
                      <div id="choices--idStatus-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="New" data-select-text="Press to select" data-choice-selectable="">New</div>
                      <div id="choices--idStatus-item-choice-5" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="5" data-value="Pending" data-select-text="Press to select" data-choice-selectable="">Pending</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--end col-->
            <div class="col-xxl-1 col-sm-4">
              <button type="button" class="btn btn-primary w-100" onClick="SearchData();"> <i class="ri-equalizer-fill me-1 align-bottom"></i> Filters </button>
            </div>
            <!--end col--> 
          </div>
          <!--end row-->
        </form>
      </div>
      <!--end card-body-->
      <div class="card-body">
        <div class="table-responsive table-card mb-4">
          <table class="table align-middle table-nowrap mb-0" id="tasksTable">
            <thead class="table-light text-muted">
              <tr>
                <th scope="col" style="width: 40px;"> <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                  </div>
                </th>
                <th class="sort " data-sort="id">ID</th>
                <th class="sort desc" data-sort="project_name">Task Order</th>
                <th class="sort" data-sort="tasks_name">Risk Number</th>
                <th class="sort" data-sort="client_name">Updates</th>
                <th class="sort" data-sort="assignedto">Assigned To</th>
                <th class="sort" data-sort="due_date">Due Date</th>
                <th class="sort" data-sort="status">Status</th>
                <th class="sort" data-sort="priority">Priority</th>
              </tr>
            </thead>
            <tbody class="list form-check-all">
              <?php foreach($techincal_updates as $techincal_update){?>
              <tr>
                <th scope="row"> <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                  </div>
                </th>
                <td class="id"><a href="apps-tasks-details.html" class="fw-medium link-primary">#VLZ10</a></td>
                <td class="project_name"><?php echo $techincal_update->task_order;?></td>
                <td><div class="d-flex">
                    <div class="flex-grow-1 tasks_name"><?php echo $techincal_update->risk_number;?></div>
                    <div class="flex-shrink-0 ms-4">
                      <ul class="list-inline tasks-list-menu mb-0">
                        <li class="list-inline-item"><a href="apps-tasks-details.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i></a></li>
                        <li class="list-inline-item"><a class="edit-item-btn" href="#showModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></a></li>
                        <li class="list-inline-item"> <a class="remove-item-btn" data-bs-toggle="modal" href="#deleteOrder"> <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> </a> </li>
                      </ul>
                    </div>
                  </div></td>
                <td class="client_name"><?php echo $techincal_update->updates;?></td>
                <td class="assignedto"><div class="avatar-group flex-nowrap"><a href="javascript: void(0);" class="avatar-group-item" data-img="assets/images/users/avatar-3.jpg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="John Robles"> <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xxs"> </a></div></td>
                <td class="due_date">15 Dec, 2020</td>
                <td class="status"><span class="badge badge-soft-secondary text-uppercase">Inprogress</span></td>
                <td class="priority"><span class="badge bg-warning text-uppercase">Medium</span></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <!--end table-->
          <div class="noresult" style="display: none">
            <div class="text-center">
              <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
              <h5 class="mt-2">Sorry! No Result Found</h5>
              <p class="text-muted mb-0">We've searched more than 200k+ tasks We did not find any tasks for you search.</p>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-end mt-2">
          <div class="pagination-wrap hstack gap-2" style="display: flex;"> <a class="page-item pagination-prev disabled" href="#"> Previous </a>
            <ul class="pagination listjs-pagination mb-0">
              <li class="active"><a class="page" href="#" data-i="1" data-page="8">1</a></li>
              <li><a class="page" href="#" data-i="2" data-page="8">2</a></li>
            </ul>
            <a class="page-item pagination-next" href="#"> Next </a> </div>
        </div>
      </div>
      <!--end card-body--> 
    </div>
    <!--end card--> 
  </div>
  <!--end col--> 
</div>
<div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0">
      <div class="modal-header p-3 bg-soft-info">
        <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
      </div>
      <form class="tablelist-form" autocomplete="off">
        <div class="modal-body">
          <input type="hidden" id="tasksId" value="#VLZ5">
          <div class="row g-3">
            <div class="col-lg-12">
              <label for="projectName-field" class="form-label">Project Name</label>
              <input type="text" id="projectName-field" class="form-control" placeholder="Project name" required>
            </div>
            <!--end col-->
            <div class="col-lg-12">
              <div>
                <label for="tasksTitle-field" class="form-label">Title</label>
                <input type="text" id="tasksTitle-field" class="form-control" placeholder="Title" required>
              </div>
            </div>
            <!--end col-->
            <div class="col-lg-12">
              <label for="clientName-field" class="form-label">Client Name</label>
              <input type="text" id="clientName-field" class="form-control" placeholder="Client name" required>
            </div>
            <!--end col-->
            <div class="col-lg-12">
              <label class="form-label">Assigned To</label>
              <div data-simplebar="init" style="height: 95px;">
                <div class="simplebar-wrapper" style="margin: 0px;">
                  <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                  </div>
                  <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                      <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 0px;">
                          <ul class="list-unstyled vstack gap-2 mb-0">
                            <li>
                              <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-2.jpg" id="james-forbes">
                                <label class="form-check-label d-flex align-items-center" for="james-forbes"> <span class="flex-shrink-0"> <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xxs rounded-circle"> </span> <span class="flex-grow-1 ms-2">James Forbes</span> </label>
                              </div>
                            </li>
                            <li>
                              <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-3.jpg" id="john-robles">
                                <label class="form-check-label d-flex align-items-center" for="john-robles"> <span class="flex-shrink-0"> <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-xxs rounded-circle"> </span> <span class="flex-grow-1 ms-2">John Robles</span> </label>
                              </div>
                            </li>
                            <li>
                              <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-4.jpg" id="mary-gant">
                                <label class="form-check-label d-flex align-items-center" for="mary-gant"> <span class="flex-shrink-0"> <img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-xxs rounded-circle"> </span> <span class="flex-grow-1 ms-2">Mary Gant</span> </label>
                              </div>
                            </li>
                            <li>
                              <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-1.jpg" id="curtis-saenz">
                                <label class="form-check-label d-flex align-items-center" for="curtis-saenz"> <span class="flex-shrink-0"> <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xxs rounded-circle"> </span> <span class="flex-grow-1 ms-2">Curtis Saenz</span> </label>
                              </div>
                            </li>
                            <li>
                              <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-5.jpg" id="virgie-price">
                                <label class="form-check-label d-flex align-items-center" for="virgie-price"> <span class="flex-shrink-0"> <img src="assets/images/users/avatar-5.jpg" alt="" class="avatar-xxs rounded-circle"> </span> <span class="flex-grow-1 ms-2">Virgie Price</span> </label>
                              </div>
                            </li>
                            <li>
                              <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-10.jpg" id="anthony-mills">
                                <label class="form-check-label d-flex align-items-center" for="anthony-mills"> <span class="flex-shrink-0"> <img src="assets/images/users/avatar-10.jpg" alt="" class="avatar-xxs rounded-circle"> </span> <span class="flex-grow-1 ms-2">Anthony Mills</span> </label>
                              </div>
                            </li>
                            <li>
                              <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-6.jpg" id="marian-angel">
                                <label class="form-check-label d-flex align-items-center" for="marian-angel"> <span class="flex-shrink-0"> <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xxs rounded-circle"> </span> <span class="flex-grow-1 ms-2">Marian Angel</span> </label>
                              </div>
                            </li>
                            <li>
                              <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-10.jpg" id="johnnie-walton">
                                <label class="form-check-label d-flex align-items-center" for="johnnie-walton"> <span class="flex-shrink-0"> <img src="assets/images/users/avatar-7.jpg" alt="" class="avatar-xxs rounded-circle"> </span> <span class="flex-grow-1 ms-2">Johnnie Walton</span> </label>
                              </div>
                            </li>
                            <li>
                              <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-8.jpg" id="donna-weston">
                                <label class="form-check-label d-flex align-items-center" for="donna-weston"> <span class="flex-shrink-0"> <img src="assets/images/users/avatar-8.jpg" alt="" class="avatar-xxs rounded-circle"> </span> <span class="flex-grow-1 ms-2">Donna Weston</span> </label>
                              </div>
                            </li>
                            <li>
                              <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-9.jpg" id="diego-norris">
                                <label class="form-check-label d-flex align-items-center" for="diego-norris"> <span class="flex-shrink-0"> <img src="assets/images/users/avatar-9.jpg" alt="" class="avatar-xxs rounded-circle"> </span> <span class="flex-grow-1 ms-2">Diego Norris</span> </label>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                </div>
                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                  <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                </div>
                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                  <div class="simplebar-scrollbar" style="height: 0px; display: none; transform: translate3d(0px, 68px, 0px);"></div>
                </div>
              </div>
            </div>
            <!--end col-->
            <div class="col-lg-6">
              <label for="duedate-field" class="form-label">Due Date</label>
              <input type="text" id="duedate-field" class="form-control flatpickr-input" data-provider="flatpickr" placeholder="Due date" required readonly>
            </div>
            <!--end col-->
            <div class="col-lg-6">
              <label for="ticket-status" class="form-label">Status</label>
              <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false">
                <div class="choices__inner">
                  <select class="form-control choices__input" data-choices="" data-choices-search-false="" id="ticket-status" hidden="" tabindex="-1" data-choice="active">
                    <option value="" data-custom-properties="[object Object]">Status</option>
                  </select>
                  <div class="choices__list choices__list--single">
                    <div class="choices__item choices__placeholder choices__item--selectable" data-item="" data-id="1" data-value="" data-custom-properties="[object Object]" aria-selected="true">Status</div>
                  </div>
                </div>
                <div class="choices__list choices__list--dropdown" aria-expanded="false">
                  <input type="text" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="Status" placeholder="">
                  <div class="choices__list" role="listbox">
                    <div id="choices--ticket-status-item-choice-5" class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="5" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Status</div>
                    <div id="choices--ticket-status-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="Completed" data-select-text="Press to select" data-choice-selectable="">Completed</div>
                    <div id="choices--ticket-status-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Inprogress" data-select-text="Press to select" data-choice-selectable="">Inprogress</div>
                    <div id="choices--ticket-status-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="New" data-select-text="Press to select" data-choice-selectable="">New</div>
                    <div id="choices--ticket-status-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Pending" data-select-text="Press to select" data-choice-selectable="">Pending</div>
                  </div>
                </div>
              </div>
            </div>
            <!--end col-->
            <div class="col-lg-12">
              <label for="priority-field" class="form-label">Priority</label>
              <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false">
                <div class="choices__inner">
                  <select class="form-control choices__input" data-choices="" data-choices-search-false="" id="priority-field" hidden="" tabindex="-1" data-choice="active">
                    <option value="" data-custom-properties="[object Object]">Priority</option>
                  </select>
                  <div class="choices__list choices__list--single">
                    <div class="choices__item choices__placeholder choices__item--selectable" data-item="" data-id="1" data-value="" data-custom-properties="[object Object]" aria-selected="true">Priority</div>
                  </div>
                </div>
                <div class="choices__list choices__list--dropdown" aria-expanded="false">
                  <input type="text" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="Priority" placeholder="">
                  <div class="choices__list" role="listbox">
                    <div id="choices--priority-field-item-choice-4" class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="4" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Priority</div>
                    <div id="choices--priority-field-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="High" data-select-text="Press to select" data-choice-selectable="">High</div>
                    <div id="choices--priority-field-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Low" data-select-text="Press to select" data-choice-selectable="">Low</div>
                    <div id="choices--priority-field-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Medium" data-select-text="Press to select" data-choice-selectable="">Medium</div>
                  </div>
                </div>
              </div>
            </div>
            <!--end col--> 
          </div>
          <!--end row--> 
        </div>
        <div class="modal-footer" style="display: block;">
          <div class="hstack gap-2 justify-content-end">
            <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" id="add-btn">Update</button>
            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update Task</button> --> 
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<?php */ ?>