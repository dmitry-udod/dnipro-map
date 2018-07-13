import { mount, shallow } from 'vue-test-utils';
import AdditionalFields from '../../resources/assets/js/components/AdditionalFields';

let wrapper;

describe('AdditionalFields', () => {
    beforeEach(() => {
        wrapper = shallow(AdditionalFields, {
            propsData: {
                fieldsJson: btoa('[{"id": "id_1", "name": "Field_1", "value": "value_1" }]'),
            }
        });
    });

    it('Correct params parsing', () => {
        expect(wrapper.vm.additionalFields.length).toBe(1);
        expect(wrapper.vm.additionalFields[0].id).toBe('id_1');
        expect(wrapper.vm.additionalFields[0].name).toBe('Field_1');
        expect(wrapper.vm.additionalFields[0].value).toBe('value_1');
        expect(wrapper.html()).toContain('value_1');
    });

    it('Add new element to fields list', () => {
        wrapper.vm.addField();
        wrapper.vm.addField();
        expect(wrapper.vm.additionalFields.length).toBe(3);
    });
});