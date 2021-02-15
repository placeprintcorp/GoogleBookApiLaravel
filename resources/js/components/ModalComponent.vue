<template>

      <transition name="modal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                  <span aria-hidden="true" @click="$emit('close')">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <center><slot name="img"></slot></center>
              <slot name="header"></slot>
              <slot name="body"></slot>
              <ul>
              <li><b>Authors:</b> <slot name="author"></slot></li>
              <li><b>Price:</b> <slot name="price"></slot></li>
              <li><b>Availablity:</b> <slot name="availablity"></slot></li>
              <li><b>Preview Link:</b> <slot name="link"></slot></li>
              </ul>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </transition>
</template>
<script>
  export default {

  data() { return { openedModal: null }  },
  methods: {
    showModal(id) {
      this.openedModal = id
    }
  }
  }
</script>