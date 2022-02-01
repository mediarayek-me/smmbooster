/*
 *  Document   : be_pages_projects_tasks.js
 *  Author     : mediarayek
 *  Description: Custom JS code used in Project Tasks and Tasks Dashboard Page
 */

// Helper variables
let taskIdNext, tasks, taskForm, taskInput, taskInputVal,
    taskList, taskListStarred, taskListCompleted,
    taskBadge, taskBadgeStarred, taskBadgeCompleted;

class pageTasks {
    /*
     * Init Tasks
     *
     */
    static initTasks() {
        let self = this;

        // Set variables
        tasks                  = jQuery('.js-tasks');
        taskForm               = jQuery('#js-task-form');
        taskInput              = jQuery('#js-task-input');

        taskList               = jQuery('.js-task-list');
        taskListStarred        = jQuery('.js-task-list-starred');
        taskListCompleted      = jQuery('.js-task-list-completed');

        taskBadge              = jQuery('.js-task-badge');
        taskBadgeStarred       = jQuery('.js-task-badge-starred');
        taskBadgeCompleted     = jQuery('.js-task-badge-completed');

        // Set your own next new task id based on your database setup
        taskIdNext = 10;

        // Update badges
        this.badgesUpdate();

        // New task form submission
        taskForm.on('submit', e => {
            e.preventDefault();

            // Get input value
            taskInputVal = taskInput.prop('value');

            // Check if the user entered something
            if (taskInputVal) {
                // Add Task
                self.taskAdd(taskInputVal);

                // Clear and focus input field
                taskInput.prop('value', '').focus();
            }
        });

        // Task status update on checkbox click
        let stask, staskId;

        tasks.on('click', '.js-task-status', e => {
            e.preventDefault();

            stask   = jQuery(e.currentTarget).closest('.js-task');
            staskId = stask.data('task-id');

            // Check task status and toggle it
            if (stask.data('task-completed')) {
                self.taskSetActive(staskId);
            } else {
                self.taskSetCompleted(staskId);
            }
        });

        // Task starred status update on star click
        let ftask, ftaskId;

        tasks.on('click', '.js-task-star', e => {
            ftask   = jQuery(e.currentTarget).closest('.js-task');
            ftaskId = ftask.data('task-id');

            // Check task starred status and toggle it
            if (ftask.data('task-starred')) {
                self.taskStarRemove(ftaskId);
            } else {
                self.taskStarAdd(ftaskId);
            }
        });

        // Remove task on remove button click
        tasks.on('click', '.js-task-remove', e => {
            ftask   = jQuery(e.currentTarget).closest('.js-task');
            ftaskId = ftask.data('task-id');

            // Remove task
            self.taskRemove(ftaskId);
        });
    }

    /*
     * Update Badges
     *
     */
    static badgesUpdate() {
        taskBadge.text(taskList.children().length || '');
        taskBadgeStarred.text(taskListStarred.children().length || '');
        taskBadgeCompleted.text(taskListCompleted.children().length || '');
    }

    /*
     * Add a new task
     *
     */
    static taskAdd(taskContent) {
        // Add it to the task list
        taskList.prepend(`
            <div class="js-task block block-rounded mb-2 animated fadeIn" data-task-id="${taskIdNext}" data-task-completed="false" data-task-starred="false">
                <table class="table table-borderless table-vcenter mb-0">
                    <tr>
                        <td class="text-center pr-0" style="width: 38px;">
                            <div class="js-task-status custom-control custom-checkbox custom-checkbox-rounded-circle custom-control-primary custom-control-lg">
                                <input type="checkbox" class="custom-control-input" id="tasks-cb-id${taskIdNext}" name="tasks-cb-id${taskIdNext}">
                                <label class="custom-control-label" for="tasks-cb-id${taskIdNext}"></label>
                            </div>
                        </td>
                        <td class="js-task-content font-w600 pl-0">
                            ${jQuery('<span />').text(taskContent).html()}
                        </td>
                        <td class="text-right" style="width: 100px;">
                            <button type="button" class="js-task-star btn btn-sm btn-link text-warning">
                                <i class="far fa-star fa-fw"></i>
                            </button>
                            <button type="button" class="js-task-remove btn btn-sm btn-link text-danger">
                                <i class="fa fa-times fa-fw"></i>
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        `);

        // Update badges
        this.badgesUpdate();

        // Save the task based on your database setup
        // ..

        // Update task next id
        taskIdNext++;
    }

    /*
     * Remove a task
     *
     */
    static taskRemove(taskId) {
        jQuery('.js-task[data-task-id="' + taskId + '"]').remove();

        // Update badges
        this.badgesUpdate();

        // Remove the task based on your database setup
        // ..
    }

    /*
     * Star a task
     *
     */
    static taskStarAdd(taskId) {
        let task = jQuery('.js-task[data-task-id="' + taskId + '"]');

        // Check if exists and update accordignly the markup
        if (task.length > 0) {
            task.data('task-starred', true);
            task.find('.js-task-star > i').toggleClass('fa far');

            if (!task.data('task-completed')) {
                task.prependTo(taskListStarred);
            }

            // Update badges
            this.badgesUpdate();

            // Star the task based on your database setup
            // ..
        }
    }

    /*
     * Unstar a task
     *
     */
    static taskStarRemove(taskId) {
        let task = jQuery('.js-task[data-task-id="' + taskId + '"]');

        // Check if exists and update accordignly the markup
        if (task.length > 0) {
            task.data('task-starred', false);
            task.find('.js-task-star > i').toggleClass('fa far');

            if (!task.data('task-completed')) {
                task.prependTo(taskList);
            }

            // Update badges
            this.badgesUpdate();

            // Unstar the task based on your database setup
            // ..
        }
    }

    /*
     * Set a task to active
     *
     */
    static taskSetActive(taskId) {
        let task = jQuery('.js-task[data-task-id="' + taskId + '"]');

        // Check if exists and update accordignly
        if (task.length > 0) {
            task.data('task-completed', false);
            task.find('.table').toggleClass('bg-body');
            task.find('.js-task-status > input').prop('checked', false);
            task.find('.js-task-content > del').contents().unwrap();

            if (task.data('task-starred')) {
                task.prependTo(taskListStarred);
            } else {
                task.prependTo(taskList);
            }

            // Update badges
            this.badgesUpdate();

            // Update task status based on your database setup
            // ..
        }
    }

    /*
     * Set a task to completed
     *
     */
    static taskSetCompleted(taskId) {
        let task = jQuery('.js-task[data-task-id="' + taskId + '"]');

        // Check if exists and update accordignly
        if (task.length > 0) {
            task.data('task-completed', true);
            task.find('.table').toggleClass('bg-body');
            task.find('.js-task-status > input').prop('checked', true);
            task.find('.js-task-content').wrapInner('<del></del>');
            task.prependTo(taskListCompleted);

            // Update badges
            this.badgesUpdate();

            // Update task status based on your database setup
            // ..
        }
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initTasks();
    }
}

// Initialize when page loads
jQuery(() => { pageTasks.init(); });
