import React, { useState } from 'react';
import Checkbox from './Checkbox';

interface CheckboxItem {
    id: number;
    name: string;
}

interface CheckboxListProps {
    checkboxItems: CheckboxItem[];
} 

export default function CheckboxList({checkboxItems}:CheckboxListProps) {
    const [checkedItems, setCheckedItems] = useState<number[]>([]);

    const handleCheckboxChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        const itemId = parseInt(event.target.value);
        setCheckedItems(prevState =>
            event.target.checked
                ? [...prevState, itemId]
                : prevState.filter(id => id !== itemId)
        );
    };

    return (
        <div>
            {checkboxItems.map(item => (
            <p><Checkbox value={item.id} onChange={handleCheckboxChange}/>{item.name}</p>
            ))}
            <p>Checked Items: {checkedItems.join(', ')}</p>
        </div>
    );
}
