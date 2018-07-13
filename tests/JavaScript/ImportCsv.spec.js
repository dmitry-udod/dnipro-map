import { mount, shallow } from 'vue-test-utils';
import ImportCsv from '../../resources/assets/js/components/ImportCsv';

let wrapper;

describe('ImportCsv', () => {
    beforeEach(() => {
        wrapper = shallow(ImportCsv, {
            propsData: {
                citiesJson: btoa('[{"id":"1", "name": "City 1"}]'),
                categoriesJson: btoa('[{"id":"1", "name": "Category 1"}]'),
            }
        });
    });

    it('is import component', () => {
        expect(wrapper.html()).toContain('Iмпорт данных з CSV файлу');
    });
});